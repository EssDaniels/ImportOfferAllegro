<?php

namespace App\Repositories;


use App\Models\TokenAllegro;
use Illuminate\Support\Facades\Auth;

class QueryAllegroRepository
{

    function getAccessToken($CurliRepo, $CID, $CS, $redirectUrl)
    {
        $authorization = base64_encode($CID . ':' . $CS);
        $authorization_code = urlencode($_GET["code"]);
        $headers = array("Authorization: Basic {$authorization}", "Content-Type: application/x-www-form-urlencoded");
        $content = "grant_type=authorization_code&code=${authorization_code}&redirect_uri=" . $redirectUrl . "/user/token/new";
        $ch = $CurliRepo->getCurl($headers, $content);
        $tokenResult = curl_exec($ch);
        $resultCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($tokenResult === false || $resultCode !== 200) {
            exit("Something went wrong $resultCode $tokenResult");
        }
        $test = json_decode($tokenResult, true);
        $token = new TokenAllegro;
        $token->access_token =  $test['access_token'];
        $token->refresh_token =  $test['refresh_token'];
        $token->id_user = Auth::user()->id;
        $token->save();
    }

    public function getQuery(CurlRepository $CurliRepo, $token, $s)
    {

        $headers = array("Authorization: Bearer {$token}", "Accept: application/vnd.allegro.public.v1+json", "Content-Type: application/vnd.allegro.public.v1+json");

        $url = "https://api.allegro.pl/sale/offers?limit=1000&offset=" . $s . "000";
        $content = [];
        $ch = $CurliRepo->cUrlGetData($url, $content, $headers);
        $categoriesList = json_decode($ch, true);
        return $categoriesList;
    }
}
