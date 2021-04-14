<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    $data = [];
    $csv_partners = array_map('str_getcsv', file('data.csv'));

    foreach ($csv_partners as $key => $partner) {

        if ($key > 0) {
            $data[] = [
                'name' => $partner[3],
                'type' => $partner[2],
                'city' => $partner[4],
                'area' => $partner[5],
                'mandoob_name' => $partner[6],
                'address' => $partner[7],
                'lat' => $partner[8],
                'lng' => $partner[9],
                'visit_date' => $partner[1] ? $partner[1] : null,
            ];
            DB::table('partners')->insert($data);
        }
    }
dd($data);
    return view('home');
});
