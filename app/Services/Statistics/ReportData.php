<?php


namespace App\Services\Statistics;



class ReportData
{
    public array $topTenCities;
    public array $topTenCountries;


    public function __construct(array $topTenCities, array $topTenCountries)
    {
        $this->topTenCities = $topTenCities;
        $this->topTenCountries = $topTenCountries;
    }

    public function apply(array $data)
    {
        if (array_key_exists("city",$data)){
            $this->topTenCities = $data;
        }
        if (array_key_exists("country",$data)){
            $this->topTenCountries = $data;
        }
    }
}
