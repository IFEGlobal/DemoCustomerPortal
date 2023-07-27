<?php

namespace App\Services\UserService;

use App\Models\Favorite;

class AddToFavorites
{
    public ?string $model;

    public ?int $id;

    public ?int $userId;

    public ?string $reference;

    public function __construct($model, $id, $userId, $reference)
    {
        $this->model = $model;

        $this->id = $id;

        $this->userId = $userId;

        $this->reference = $reference;
    }

    public function CheckExistance()
    {
        $check = Favorite::where('user_id', $this->userId)->where('favorable_id', $this->id)->where('favorable_type', $this->model)->first();

        if($check)
        {
            return ['type' => 'warning', 'title' => 'Failed', 'message' => $this->reference.' already in favorites'];
        }

        return $this->AddToFavorates();
    }

    public function AddToFavorates()
    {
        Favorite::create([
            'user_id' => $this->userId,
            'favorable_id' => $this->id,
            'favorable_reference' => $this->reference,
            'favorable_type' => $this->model
        ]);

        return ['type' => 'success', 'title' => 'Success', 'message' => $this->reference.' added to favorites'];
    }

}
