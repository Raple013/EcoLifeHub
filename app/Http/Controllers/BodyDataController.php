<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BodyDataController extends Controller
{
    public function index()
    {
        if (auth()->user()->weight_kg && auth()->user()->height_cm) {
            return redirect()->route('dashboard');
        }

        return view('auth.body-data');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'weight_kg' => ['required', 'numeric', 'min:20', 'max:300'],
            'height_cm' => ['required', 'integer', 'min:80', 'max:250'],
        ]);

        auth()->user()->update($validated);

        return redirect()->route('dashboard');
    }
}
