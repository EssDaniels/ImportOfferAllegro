<?php

namespace App\Http\Controllers;

use App\Models\UserAllegro;
use App\Models\TokenAllegro;
use App\Models\OfferAllegro;
use App\Models\Setting;

use App\Repositories\UserAllegroRepository;
use App\Repositories\TokenUserRepository;
use App\Repositories\QueryAllegroRepository;
use App\Repositories\OfferAllegroRepository;
use App\Repositories\CurlRepository;
use App\Repositories\SettingRepository;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function list()
    {
        $data = UserAllegro::all();
        return view('import.list', ['data' => $data]);
    }
    public function user(CurlRepository $CurliRepo, $id, UserAllegroRepository $UARepo, TokenUserRepository $Token, QueryAllegroRepository $QARepo, OfferAllegroRepository $OARepo, SettingRepository $setRep)
    {
        $i = 0;
        $importCsv = [];
        //Ustawienie lokalizacji wygenerowanego pliku csv z importu
        $set = $setRep->getSetting();
        if ($set->filepath == null) {
            return view('import.setting');
        }

        $location = $set->filepath;
        if (!is_dir($location)) {
            mkdir($location);
        }

        //Pobieranie danych o ofertach
        $user = $UARepo->getUserName($id);
        $Token = TokenAllegro::find($user->id);
        $data = $QARepo->getQuery($CurliRepo, $Token->access_token, $i);

        //Blok tworzenia pliku csv i nadawanie mu nazwy
        $date = date('dmY_His', time());
        $filename = $location . '\offer' . $date . '.csv';

        //Przekazywanie danych do pliku csv
        $fp = fopen($filename, 'w');
        $arrTocsv = ['id', 'name', 'price', 'currency', 'stock'];
        fputcsv($fp, $arrTocsv, ';');
        $importCsv = [];

        $licznik = 0;
        foreach ($data['offers'] as $row) {
            $offerExist = $OARepo->getOffer($row['id']);
            if (!isset($offerExist)) {
                $offer = new OfferAllegro;
                $offer->id_user = $user->id;
                $offer->id_offer = $row['id'];
                $offer->save();
                $importCsv[] = $row['id'];
                $importCsv[] = $row['name'];
                if (isset($row['sellingMode']['price'])) {
                    $importCsv[] = $row['sellingMode']['price']['amount'];
                    $importCsv[] = $row['sellingMode']['price']['currency'];
                } else {
                    $importCsv[] = null;
                    $importCsv[] = null;
                }
                $importCsv[] = $row['stock']['available'];
                fputcsv($fp, $importCsv, ';');
                $importCsv = [];
                $licznik++;
            }
        }
        fclose($fp);

        return view('import.file', ['licznik' => $licznik, 'name' => $user->name]);
    }
    public function setting()
    {
        return view('import.setting');
    }
    public function settingstore(Request $request, SettingRepository $SetRep)
    {

        $request->validate([            //validacja : reszta w dokumentacji laravel
            'url' => 'required',
            'file' => 'required'
        ]);

        $setting = new Setting;
        $setting->redirectUrl = $request->input('url');
        $setting->filepath = $request->input('file');
        $setting->save();
        return view('import.setting');
    }
}
