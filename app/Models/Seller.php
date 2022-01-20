<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = [
        "description",
        "saldo"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
