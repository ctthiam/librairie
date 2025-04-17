<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('books')->get();
        return view('orders.index', compact('orders'));
    }

    public function showBook(Book $book)
    {
        if ($book->archived || $book->stock <= 0) {
            abort(404); // Livre non disponible pour les clients
        }
        return view('orders.book', compact('book'));
    }

    public function catalog(Request $request)
    {
        $query = Book::where('archived', false)->where('stock', '>', 0);
    
        // Filtre par prix avec validation
        if ($request->has('price_min')) {
            $priceMin = $request->input('price_min');
            if (!is_numeric($priceMin)) {
                return redirect()->route('orders.catalog')->withErrors('Le prix minimum doit être un nombre.');
            }
            $query->where('price', '>=', $priceMin);
        }
        if ($request->has('price_max')) {
            $priceMax = $request->input('price_max');
            if (!is_numeric($priceMax)) {
                return redirect()->route('orders.catalog')->withErrors('Le prix maximum doit être un nombre.');
            }
            $query->where('price', '<=', $priceMax);
        }
    
        // Filtre par auteur
        if ($request->has('author') && $request->input('author')) {
            $query->where('author', 'like', '%' . $request->input('author') . '%');
        }
    
        // Filtre par catégorie
        if ($request->has('category') && $request->input('category')) {
            $query->where('category', 'like', '%' . $request->input('category') . '%');
        }
    
        $books = $query->get();
        $cart = session('cart', []);
    
        return view('orders.catalog', compact('books', 'cart'));
    }

    // Ajouter un livre au panier
    public function addToCart(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $book = Book::find($request->book_id);
        if ($book->stock < $request->quantity) {
            return back()->withErrors("Stock insuffisant pour {$book->title}");
        }

        $cart = session('cart', []);
        $cart[$book->id] = [
            'id' => $book->id,
            'title' => $book->title,
            'price' => $book->price,
            'quantity' => $request->quantity,
        ];
        session(['cart' => $cart]);

        return redirect()->route('orders.catalog')->with('success', 'Livre ajouté au panier !');
    }

    // Créer la commande depuis le panier
    public function store(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('orders.catalog')->withErrors('Le panier est vide.');
        }

        $order = Order::create(['status' => 'en attente']);
        foreach ($cart as $item) {
            $book = Book::find($item['id']);
            $order->books()->attach($book->id, ['quantity' => $item['quantity']]);
            $book->stock -= $item['quantity'];
            $book->save();
        }

        session()->forget('cart'); // Vide le panier
        return redirect()->route('orders.show', $order)->with('success', 'Commande créée avec succès !');
    }

    public function show(Order $order)
    {
        $order->load('books');
        return view('orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:en attente,en préparation,expédiée,payée',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Statut mis à jour !');
    }

    public function destroy(Order $order)
    {
        foreach ($order->books as $book) {
            $book->stock += $book->pivot->quantity;
            $book->save();
        }
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Commande annulée !');
    }
}