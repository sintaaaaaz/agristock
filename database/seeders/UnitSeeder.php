<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{

    public function run(): void
    {

        $units = [

            [
                'name'=>'Kg'
            ],

            [
                'name'=>'Box'
            ],

            [
                'name'=>'Ikat'
            ],

            [
                'name'=>'Pcs'
            ],
        ];


        foreach($units as $unit){

            Unit::create($unit);

        }

    }
}