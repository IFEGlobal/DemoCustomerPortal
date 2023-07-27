<?php

namespace App\Services\UserService;

use App\Models\Priority;

class AddToPriority
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
        $check = Priority::where('user_id', $this->userId)->where('prioratable_id', $this->id)->where('prioratable_type', $this->model)->first();

        if($check)
        {
            return ['type' => 'warning', 'title' => 'Failed', 'message' => $this->reference.' already in priority list'];
        }

        return $this->AddToFavorates();
    }

    public function AddToFavorates()
    {
        Priority::create([
            'user_id' => $this->userId,
            'prioratable_id' => $this->id,
            'prioratable_reference' => $this->reference,
            'prioratable_type' => $this->model
        ]);

        return ['type' => 'success', 'title' => 'Success', 'message' => $this->reference.' added to priority list'];
    }
}
