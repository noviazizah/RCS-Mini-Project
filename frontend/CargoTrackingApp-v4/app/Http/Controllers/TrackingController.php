<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Train;
use App\Models\Station;

class TrackingController extends Controller
{
    public function index()
    {
        return view('tracking');
    }

    public function track(Request $request)
    {
        $request->validate([
            'TrainNumber' => 'required|string|max:20',
            'captcha' => 'required|string',
        ]);

        // Logika validasi captcha disini, jika diperlukan

        $train = Train::where('TrainNumber', $request->TrainNumber)->first();
        $stations = Station::all();

        if ($train) {
            // Pastikan route dalam bentuk array
            $train->Route = is_string($train->Route) ? explode(',', $train->Route) : $train->Route;
            return view('track-result', ['train' => $train, 'stations' => $stations]);
        } else {
            return view('track-result', ['error' => 'Nomor KA tidak ditemukan.']);
        }
    }
}
