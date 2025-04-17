<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::where('archived', false)->get();
        return view('books.index', compact('books'));
    }

    public function archived()
    {
        $books = Book::where('archived', true)->get();
        return view('books.archived', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);
    
        $book = new Book($request->all());
        if ($request->hasFile('image')) {
            $book->image = $request->file('image')->store('books', 'public');
        }
        $book->save();
    
        return redirect()->route('books.index')->with('success', 'Livre ajouté !');
    }
    
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
        ]);
    
        $book->update($request->all());
        if ($request->hasFile('image')) {
            $book->image = $request->file('image')->store('books', 'public');
        }
        $book->save();
    
        return redirect()->route('books.index')->with('success', 'Livre mis à jour !');
    }

    // Nouvelle méthode show
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function archive(Book $book)
    {
        $book->archived = true;
        $book->save();
        return redirect()->route('books.index')->with('success', 'Livre archivé !');
    }

    public function unarchive(Book $book)
    {
        $book->archived = false;
        $book->save();
        return redirect()->route('books.archived')->with('success', 'Livre désarchivé !');
    }

    public function destroy(Book $book)
    {
        if ($book->image) {
            \Storage::disk('public')->delete($book->image);
        }
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Livre supprimé définitivement !');
    }
}