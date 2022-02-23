<?php

namespace App\Repositories;

use App\Models\UserAllegro;

class UserAllegroRepository extends BaseRepository
{

    public function __construct(UserAllegro $model)
    {
        $this->model = $model;
    }
    public function getUser($email)
    {
        return $this->model->where('email', '=', $email)->first();
    }
    public function getUserName($name)
    {
        return $this->model->where('name', '=', $name)->first();
    }
}
