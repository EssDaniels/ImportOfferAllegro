<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingRepository extends BaseRepository
{

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }
    public function getSetting()
    {
        return DB::table('setting')->latest()->first();
    }
}
