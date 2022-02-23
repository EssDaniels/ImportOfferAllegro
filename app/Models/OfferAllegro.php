<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferAllegro extends Model
{
    use HasFactory;
    protected $table = 'a_offer_allegro';

    protected $fillable = [
        'id_user',
        'id_offer'
    ];
}
