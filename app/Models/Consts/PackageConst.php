<?php

namespace App\Models\Consts;

use Illuminate\Database\Eloquent\Model;

class PackageConst extends Model
{
    const PACKAGES = [
        'Standard' => [
            'standardSums'  => [50, 250, 500, 1000, 2500, 5000, 10000],
            'min'           => 50,
            'max'           => 10000,
        ],
        'Light' => [
            'min'   => 1000,
            'max'   => 100000,
        ],
        'Mini' => [
            'min' => 100,
            'max' => 2000,
        ],
    ];
}
