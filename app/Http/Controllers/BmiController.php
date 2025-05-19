<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BmiController extends Controller
{
    public function index(Request $request)
    {
        $bmi = null;
        $idealWeight = null;

        if ($request->has('weight') && $request->has('height') && $request->has('gender')) {
            $weight = $request->input('weight');
            $height = $request->input('height') / 100; // Ubah tinggi badan ke meter
            $gender = $request->input('gender');

            // Perhitungan BMI
            $bmi = $weight / ($height * $height);

            // Perhitungan Berat Badan Ideal (BBI)
            if ($gender == 'male') {
                $idealWeight = ($height * 100 - 100) - (($height * 100 - 150) / 4);
            } else {
                $idealWeight = ($height * 100 - 100) - (($height * 100 - 150) / 2.5);
            }
        }

        return view('bmi', compact('bmi', 'idealWeight'));
    }
}
