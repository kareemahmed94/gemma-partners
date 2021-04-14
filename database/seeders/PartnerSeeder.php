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
                $data[] = [
                    'name' => $partner[3],
                    'type' => $partner[2],
                    'city' => $partner[4],
                    'area' => $partner[5],
                    'mandoob_name' => $partner[6],
                    'address' => $partner[7],
                    'lat' => $partner[8],
                    'lng' => $partner[9],
                    'visit_date' => $partner[1] != '' ? $partner[1] : null,
                ];
            }
        }
        DB::table('partners')->insert($data);
    }
}
