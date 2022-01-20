<?php

namespace App\Models;

use App\Models\Card;
use App\Models\Item;
use App\Models\Seller;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "role"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function order_item()
    {
        return $this->belongToMany(Item::class, "order_items", "user_id", "item_id");
    }

    public function seller()
    {
        return $this->hasOne(Seller::class);
    }

    public function card()
    {
        return $this->hasOne(Card::class);
    }

    public function seller_item()
    {
        return $this->hasMany(Item::class);
    }
}
