<?php


namespace App\Http\Validators;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CardPutValidator
{
    private $rules;

    private $messages = [];

    private $data;

    /** @var \Illuminate\Contracts\Validation\Validator */
    private $validator;

    private $errorMessages;

    public function __construct(array $data, $id)
    {
        $this->data = $data;
        $this->rules = [
            'name' => 'required|string|unique:cards,name,'.$id,
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
    }

    public function getValidator() {
        return $this->validator;
    }

    static public function make(array $data, $id){
        return new self($data, $id);
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
