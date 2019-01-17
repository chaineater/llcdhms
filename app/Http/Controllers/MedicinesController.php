<?php

namespace App\Http\Controllers;

use App\Medicines;
use Illuminate\Http\Request;

class MedicinesController extends Controller
{
    public function getAllMedicines() {
        $data = Medicines::all();

        return response()->json($data);
    }
}
