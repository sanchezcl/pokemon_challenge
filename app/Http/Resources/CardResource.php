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

    /**
     * @OA\Schema(
     * @OA\Xml(name="Card"),
     *       schema="Card",
     *       @OA\Property(property="name", type="string", example="dito"),
     *       @OA\Property(property="health_points", type="integer", example="50"),
     *       @OA\Property(property="is_first_edition", type="boolean", example="true"),
     *       @OA\Property(property="is_taken", type="boolean", example="true"),
     *       @OA\Property(property="expansion_set", type="integer", example="1"),
     *       @OA\Property(property="pokemon_type", type="array", @OA\Items(type="string", example="Fire"),),
     *       @OA\Property(property="card_rarity", type="integer", example="1"),
     *       @OA\Property(property="price", type="number", example="10.50"),
     *       @OA\Property(property="image_url", type="url", format="url", example="www.pokeimage.com/01"),
     *       @OA\Property(property="created_at", type="date", example="2021-11-29"),
     * )
     */
}
