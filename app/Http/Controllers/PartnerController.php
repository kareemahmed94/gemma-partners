<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $data = Location::get('197.47.101.153');
        $lat = $data->latitude;
        $lng = $data->longitude;
        $partners = Partner::latest('id');
        $types = Partner::distinct('type');
        $cities = Partner::distinct('city');
        if ($request->input('type')) {
            $partners = $partners->where('type' , $request->input('type'));
            $cities = Partner::where('type' , $request->input('type'))->distinct('city');
        }
        if ($request->input('city')) {
            $partners = $partners->where('city' , $request->input('city'));
        }
        $partners = $partners->get();
        return response()->json(['status' => 200 , 'data' => $partners , 'lat' => $lat , 'lng' => $lng,
            'types' => $types->pluck('type'), 'cities' => $cities->pluck('city') ]);
    }
    public function show($id)
    {
        $partner = Partner::find($id);
        return response()->json(['status' => 200 , 'data' => $partner]);
    }
}
