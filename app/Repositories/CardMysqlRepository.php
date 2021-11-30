<?php


namespace App\Repositories;


use App\Models\Card;

class CardMysqlRepository implements CardRepositoryInterface
{
    const PAGE_SIZE = 10;

    public function findAll($queries)
    {
        return Card::applyFilters($queries['filters'])
            ->applyShorts($queries['sorts'])
            ->paginate(
                self::PAGE_SIZE,
                ['*'],
                'page',
                $queries['page']
            );
    }

    public function create($data)
    {
        $card = new Card([
            'name' => $data['name'],
            'health_points' => $data['health_points'],
            'is_first_edition' => $data['is_first_edition'],
            'is_taken' => $data['is_taken'],
            'price' => $data['price'],
            'image_url' => $data['image_url'],
        ]);
        $card->cardRarity()->associate($data['card_rarity']);
        $card->expansionSet()->associate($data['expansion_set']);
        $card->save();
        $card->pokemonTypes()->sync($data['pokemon_type']);
        return $card;
    }

    public function findById($id)
    {
        return Card::findOrFail($id);
    }

    public function update(int $id, array $card_data)
    {
        /** @var Card $card */
        $card = $this->findById($id);
        $card->updateOrFail($card_data);
        $card->pokemonTypes()->sync($card_data['pokemon_type']);
        return $card;
    }

    public function deleteById($id)
    {
        $card = $this->findById($id);
        $card->pokemonTypes()->detach($card->pokemonTypes->pluck('id'));
        return Card::destroy($id);
    }

    public function takeCard($id)
    {
        $card = $this->findById($id);
        $card->is_taken = true;
        $card->save();
        return $card;
    }

    public function returnCard($id)
    {
        $card = $this->findById($id);
        $card->is_taken = false;
        $card->save();
        return $card;
    }

    public function returnAllCards()
    {
        return Card::where('is_taken', true)->update(['is_taken' => false]);
    }
}
