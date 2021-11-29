<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Card extends Model
{

    protected $fillable = [
        'name',
        'health_points',
        'is_first_edition',
        'price',
        'image_url',
    ];

    public function cardRarity()
    {
        return $this->belongsTo(CardRarity::class);
    }

    public function expansionSet()
    {
        return $this->belongsTo(ExpansionSet::class);
    }

    public function pokemonTypes()
    {
        return $this->belongsToMany(PokemonType::class);
    }

    public function getPriceAttribute($value)
    {
        return floatval($value);
    }
}
