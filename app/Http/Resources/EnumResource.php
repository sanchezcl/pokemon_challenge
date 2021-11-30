<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class EnumResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}

/**
 *     @OA\Schema(
 *         schema="enumJson",
 *         @OA\Xml(name="InfoData"),
 *         @OA\Property(property="id", type="integer", example="1"),
 *         @OA\Property(property="name", type="string", example="item name"),
 *     )
 */
