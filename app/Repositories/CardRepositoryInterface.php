<?php


namespace App\Repositories;


interface CardRepositoryInterface
{
    public function create(array $data);

    public function findById(int $id);

    public function deleteById(int $id);

    public function update(int $id, array $card_data);

    public function findAll($queries);
}
