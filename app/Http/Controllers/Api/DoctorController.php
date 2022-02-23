<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class DoctorController extends BaseController
{

    public function index(UserRepository $userRepo)
    {
        $users = $userRepo->getAllDoctores();

        return $users->toJson();
    }
    public function show(UserRepository $userRepo, $id)
    {

        $doctor = $userRepo->find($id);
        return  $doctor->toJson();
    }
}
