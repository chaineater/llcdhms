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

    public function addMedicines () {
        $data = new Medicines;
        $data->brand_name = request('brand_name');
        $data->generic_name = request('generic_name');
        $data->price = request('price');
        $data->quantity = request('quantity');
        $data->expiration_date = request('expiration_date');
        $data->save();
    }

    public function updateMedicinesQuantity () {
        $data = Medicines::where(request('id'))->update([
            'quantity' => request('quantity')
        ]);
    }
}
