<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $csv_partners = array_map('str_getcsv', file(public_path('data.csv')));

        foreach ($csv_partners as $key => $partner) {
            if ($key > 0) {
                $date = null;
                if (isset($partner[1]) && $partner[1] != "") {
                    $exploaded = explode('/', $partner[1]);
                    if (is_array($exploaded)) {
                        $day = (int)$exploaded[1] >= 10 ? $exploaded[1] : (int)'0' . $exploaded[1];
                        $month = (int)$exploaded[0] >= 10 ? $exploaded[0] : (int)'0' . $exploaded[0];
                        $year = (int)'20' . $exploaded[2];
                        $date = $year . '-' . $month . '-' . $day;
                    }
                }
                $data[] = [
                    'name' => $partner[3],
                    'type' => $partner[2],
                    'city' => $partner[4],
                    'area' => $partner[5],
                    'mandoob_name' => $partner[6],
                    'address' => $partner[7],
                    'lat' => $partner[8],
                    'lng' => $partner[9],
                    'visit_date' => $date,
                ];
            }
        }
        DB::table('partners')->insert($data);
    }
}
