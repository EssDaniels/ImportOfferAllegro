<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\OfferAllegro;

class OfferAllegroRepository extends BaseRepository
{

    public function __construct(OfferAllegro $model)
    {
        $this->model = $model;
    }
    public function getOffer($id)
    {
        return $this->model->where('id_offer', '=', $id)->first();
    }
}
