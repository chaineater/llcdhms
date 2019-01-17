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
}
