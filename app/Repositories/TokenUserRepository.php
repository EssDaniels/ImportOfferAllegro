<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\TokenAllegro;

class TokenUserRepository extends BaseRepository
{

    public function __construct(TokenAllegro $model)
    {
        $this->model = $model;
    }
    public function getUser($email)
    {
        return $this->model->where('email', '=', $email)->first();
    }
    public function getTokenAllegro($id)
    {
        return DB::table('a_token_user_allegro')->where('id_user', '=', $id)->latest()->first();
        return $this->model->where('id_user', '=', $id)->latest()->first();
    }
}
