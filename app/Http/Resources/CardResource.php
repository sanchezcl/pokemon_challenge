<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'health_points' => $this->health_points,
            'is_first_edition' => $this->is_first_edition,
            'is_taken' => $this->is_taken,
            'expansion_set' => $this->expansionSet->name,
            'pokemon_type' => $this->pokemonTypes->pluck('name'),
            'card_rarity' => $this->cardRarity->name,
            'price' => $this->price,
            'image_url' => $this->image_url,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
