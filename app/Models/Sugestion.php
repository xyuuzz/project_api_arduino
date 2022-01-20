<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sugestion extends Model
{
    use HasFactory;

    protected $fillable = [
        "description",
        "rating"
    ];

    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
