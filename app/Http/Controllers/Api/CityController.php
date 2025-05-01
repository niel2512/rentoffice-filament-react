<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CityResource;

class CityController extends Controller
{
    public function index()
    {
//variabel cities mengambil data dari model City dengan menghitung data officeSpaces nya
//hey model city ambil seluruh data city  termasuk officeSpaces nya dihitung kira-kira satu kota ada berapa officeSpaces
        $cities = City::withCount('officeSpaces')->get();
        return CityResource::collection($cities); //collection CityResource untuk menampilkan banyak data
    }
    public function show(City $city) //kroscek model binding di database 
    {
//kita ambil data city berdasarkan slug yang ada di database cities yang berelasi officespace pada kolom city dan photos
        $city->load(['officeSpaces.city', 'officeSpaces.photos']);
        $city->loadCount('officeSpaces');
        return new CityResource($city); //new CityResource untuk menampilkan satu data
    }
}
