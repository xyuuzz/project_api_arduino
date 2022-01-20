<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($user)
    {
        return [
            "name" => $user->name,
            "email" => $user->email,
            "card_id" => $user->card->card_id,
            "nis" => $user->card->nis,
            "saldo" => $user->card->saldo
        ];
    }
}
