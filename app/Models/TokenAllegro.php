<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenAllegro extends Model
{
    use HasFactory;

    protected $table = 'a_token_user_allegro';

    protected $fillable = [
        'id_user',
        'access_token',
        'refresh_token'


    ];
}
