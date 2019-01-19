<?php

namespace App\Http\Controllers;

use App\Laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function getAllLabs() {
        $data = Laboratory::all();

        return response()->json($data);
    }

    public function addLab () {
        $data = new Laboratory;
        $data->lab_name = request('lab_name');
        $data->lab_price = request('lab_price');
        $data->save();
    }
}
