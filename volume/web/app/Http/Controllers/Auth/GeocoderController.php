<?php
use Geocoder\Laravel\ProviderAndDumperAggregator as Geocoder;

class GeocoderController extends Controller
{
    public function getGeocode(Geocoder $geocoder)
    {
        $geocoder->geocode('Los Angeles, CA')->get();
    }
}
