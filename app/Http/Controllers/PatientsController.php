<?php

namespace App\Http\Controllers;

use App\Patients;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function getAllPatients() {
        $data = Patients::all();

        return response()->json($data);
    }
}
