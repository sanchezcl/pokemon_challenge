<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ExpansionSet extends Model
{
    public function card()
    {
        return $this->hasMany(Card::class);
    }
}
