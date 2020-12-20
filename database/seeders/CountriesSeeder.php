<?php


namespace Database\Seeders;


use App\Models\Country;
use Database\Factories\CountryFactory;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    public function run(): void
    {
        $client = new Client();
        $response = $client->get("https://restcountries.eu/rest/v2/all");
        $data = json_decode((string)$response->getBody(), true);
        $collection = collect($data)->map(function ($country) {
            return [
                "name" => $country["name"],
                "code" => $country["alpha2Code"],
                "flag_uri" => $country["flag"],
            ];
        });

        foreach ($collection as $element) {
            Country::create($element);
        }
    }
}
