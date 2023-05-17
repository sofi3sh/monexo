<?php
    
    namespace App\Http\Controllers\API;
    use App\Http\Controllers\Controller;

    class CitiesController extends Controller {
        public function index($country) {
            $filename = "cities/" . $country .".txt";
            $cities = explode("\n", @file_get_contents($filename));
            $newArray = [];
            
            foreach ($cities as $key => $value)
                $newArray[] = ['label' => $value, 'value' => $value];

            return $newArray;
        }
    }