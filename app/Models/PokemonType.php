<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PokemonType extends Model
{
    public function cards()
    {
        return $this->belongsTo(Card::class);
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
