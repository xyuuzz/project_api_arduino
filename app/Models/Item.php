<?php

namespace App\Models;

use App\Models\{
    Category,
    Sugestion,
    User
};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "price",
        "banner",
        "category_id"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sugestion()
    {
        return $this->belongsTo(Sugestion::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function order_user()
    {
        return $this->belongsToMany(User::class, "order_items", "item_id", "user_id");
    }
}
