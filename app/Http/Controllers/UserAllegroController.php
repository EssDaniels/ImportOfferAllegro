<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAllegro;
use App\Repositories\QueryAllegroRepository;
use App\Repositories\SettingRepository;
use App\Repositories\CurlRepository;
use Illuminate\Support\Facades\Auth;


class UserAllegroController extends Controller
{
    public function create()
    {
        return view('import.create');
    }

    public function store(Request $request)
    {

        $request->validate([            //validacja : reszta w dokumentacji laravel
            'name' => 'required|max:255',
            'nip' => 'max:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
            'phone' => 'required'

        ]);

        $user = new UserAllegro;
        $user->name = $request->input('name');
        $user->nip = $request->input('nip');
        $user->password = bcrypt($request->input('password'));
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->save();

        return view('import.create');
    }
    public function token(SettingRepository $setting)
    {
        $url = $setting->getSetting();
        $url =  $url->redirectUrl;

        return view('import.token', ['url' => $url]);
    }

    public function gettoken(Request $request, SettingRepository $setting)
    {
        $request->validate([            //validacja : reszta w dokumentacji laravel
            'email' => 'required',
            'clientId' => 'required',
            'clientSecret' => 'required',
        ]);
        $clientId = $request->input('clientId');
        $clientSecret = $request->input('clientSecret');
        setcookie('client',  $clientId, time() + 100);
        setcookie('clientS',  $clientSecret, time() + 100);
        $reURL = $setting->getSetting();
        $reURL = $reURL->redirectUrl;
        $authorization_redirect_url = "https://allegro.pl/auth/oauth/authorize?response_type=code&client_id="
            . $clientId . "&redirect_uri=" . $reURL . "/user/token/new";


        return view('import.getcode', ['buttonAllegro' => $authorization_redirect_url]);
    }
    public function createToken(QueryAllegroRepository $QARepo, CurlRepository $CurliRepo, SettingRepository $setting)
    {
        $ck = $_COOKIE['client'];
        $cs = $_COOKIE['clientS'];
        $reURL = $setting->getSetting();
        $reURL = $reURL->redirectUrl;
        $QARepo->getAccessToken($CurliRepo, $ck, $cs, $reURL);
        $name = Auth::user()->name;
        return view('import.show', ['name' => $name]);
    }
}
