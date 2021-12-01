<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class Card extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'health_points',
        'is_first_edition',
        'price',
        'image_url',
    ];

    protected $casts = [
        'is_first_edition' => 'boolean',
        'is_taken' => 'boolean',
    ];

    protected $allowed_sorts = [
        'name',
        'health_points',
        'price',
        'is_first_edition',
        'is_taken',
    ];

    private $allowed_filters = [
        'name' => [
            'is_related' => false,
        ],
        'is_taken' => [
            'is_related' => false,
        ],
        'expansionSet' => [
            'is_related' => true,
            'relate_field' => 'name'
        ],
        'pokemonTypes' => [
            'is_related' => true,
            'relate_field' => 'name'
        ]
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

    public function scopeApplyFilters(Builder $query, $filters)
    {
        if (is_null($filters)) {
            return;
        }

        foreach ($filters as $field => $value) {
            if(!array_key_exists($field, $this->allowed_filters)){
                throw new BadRequestException('Filter not allowed with field: '. $field);
            }

            if ($this->allowed_filters[$field]['is_related']){
                $query->WhereHas($field, function(Builder $q) use ($field, $value){
                    $q->where($this->allowed_filters[$field]['relate_field'], $value);
                });

            } else {
                $query->where($field, $value);
            }
        }
    }

    public function scopeApplyShorts(Builder $query, $sorts)
    {
        if (is_null($sorts)) {
            return;
        }

        $sorts = Str::of($sorts)->explode(',');
        foreach($sorts as $sort) {
            $sort_data = explode(':',$sort);
            $field = $sort_data[0];
            $direction = (isset($sort_data[1]))? $sort_data[1] : 'asc';

            if(!in_array($field, $this->allowed_sorts)){
                throw new BadRequestException('Sort not allowed with field: '. $field);
            }
            $query->orderBy($field, $direction);
        }
    }

}
