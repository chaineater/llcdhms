<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    public function getAllTransactions () {
        $data = Transaction::all();

        return response()->json($data);
    }

    public function addTransaction (Request $request) {
        $this->validate($request, [
            'patients_name' => 'required',
            'patients_id' => 'required',
            'incharge_doctor' => 'required',
            'date_admitted' => 'required',
            'ward' => 'required',
            'bed' => 'required'
        ]);
        $last = DB::table('transactions')->latest('id')->first();

        $tid = !$last ? 'TID_00000000' : $last->transaction_id;
        $tid++;

        $data = new Transaction;
        $data->transaction_id = $tid;
        $data->patients_name = request('patients_name');
        $data->patients_id = request('patients_id');
        $data->incharge_doctor = request('incharge_doctor');
        $data->date_admitted = request('date_admitted');
        $data->ward = request('ward');
        $data->bed = request('bed');
        $data->save();
    }

    public function getPatientTransactions () {
        $data = Transaction::where('patients_id', request('pid'))->get();

        return response()->json($data);
    }
}
