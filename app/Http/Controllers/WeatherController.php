<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class WeatherController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
//        dump(City::orderBy('number_of_searches','DESC')->get()); die;
        $forecast = [];
        $api_key = config("openweathermap.api_key");
        $ip_address = $_SERVER["HTTP_HOST"];
        $geopluginUrl = 'http://www.geoplugin.net/php.gp?ip='.$ip_address;
        $addrDetailsArr = unserialize(file_get_contents($geopluginUrl));
        $city = $addrDetailsArr['geoplugin_city'];
        $weatherUrl = 'api.openweathermap.org/data/2.5/weather?q='.$city.'&units=metric&appid='.$api_key;
        $client = new \GuzzleHttp\Client();
        $response = $client->get($weatherUrl);
        if ($response->getStatusCode() == 200) {
            $responseBody = $response->getBody();
            $obj = json_decode($responseBody);
            $forecast["city"] = $city;
            $forecast["country"] = $obj->sys->country;
            $forecast["description"] = $obj->weather[0]->description;
            $forecast["temperature"] = $obj->main->temp;
        }
        return view('index', ["forecast" => $forecast]);
    }

    public function changeCity(Request $request)
    {
        $forecast = [];
        $api_key = config("openweathermap.api_key");
        $city = request('city');
        if(City::where('name', '=', $city)->first())
        {
            $number_of_searches = City::where('name', '=', $city)->get()[0]->number_of_searches;
            $affectedRows = City::where('name', '=', $city)->update(['number_of_searches' => ($number_of_searches + 1)]);
        }
        else
        {
            City::create(['name' => $city,'number_of_searches' => '1']);
        }
        $weatherUrl = 'api.openweathermap.org/data/2.5/weather?q='.$city.'&units=metric&appid='.$api_key;
        $client = new \GuzzleHttp\Client();
        $response = $client->get($weatherUrl);
        if ($response->getStatusCode() == 200) {
            $responseBody = $response->getBody();
            $obj = json_decode($responseBody);
            $forecast["city"] = $city;
            $forecast["country"] = $obj->sys->country;
            $forecast["description"] = $obj->weather[0]->description;
            $forecast["temperature"] = $obj->main->temp;
        }

        return response(json_encode($forecast));
    }
}
