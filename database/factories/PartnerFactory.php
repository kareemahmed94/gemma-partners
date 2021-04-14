<?php

namespace Database\Factories;


use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PartnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
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
                    'visit_date' => $partner[1],
                ];
            }
        }
        return $data;
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
