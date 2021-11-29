<?php


namespace App\Http\Validators;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CardPostValidator
{
    private $rules = [
        'name' => 'required|string|unique:cards,name',
        'health_points' => 'required|numeric',
        'is_first_edition' => 'required|boolean',
        'is_taken' => 'required|boolean',
        'expansion_set' => 'required|exists:expansion_sets,id',
        'pokemon_type' => 'required|array|min:1',
        'pokemon_type.*' => 'numeric',
        'card_rarity' => 'required|numeric|exists:card_rarities,id',
        'price' => 'required|numeric',
        'image_url' => 'required|string'
    ];

    private $messages = [];

    private $data;

    /** @var \Illuminate\Contracts\Validation\Validator */
    private $validator;

    private $errorMessages;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getValidator() {
        return $this->validator;
    }

    static public function make(array $data){
        return new self($data);
    }

    public function validate()
    {
        $this->validator = Validator::make($this->data, $this->rules, $this->messages);
        $fails = $this->validator->fails();
        if ($fails){
            throw new ValidationException($this->validator);
        }
        return !$fails;
    }

    public function getErrors()
    {
        return $this->errorMessages;
    }
}
