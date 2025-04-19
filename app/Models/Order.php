<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['status'];

    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot('quantity');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Nouvelle méthode pour vérifier si la commande est payée
    public function isPaid()
    {
        return $this->payment !== null;
    }
}