<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cards extends Model
{
    use HasFactory;

    protected $fillable = [
        "nis",
        "card_id",
        "saldo"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
