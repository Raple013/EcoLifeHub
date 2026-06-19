<?php

namespace App\Http\Controllers;

use App\Models\Sdg;

class SdgController extends Controller
{
    public function show(int $id)
    {
        $sdg = Sdg::findOrFail($id);
        return view('sdg-detail', compact('sdg'));
    }
}
