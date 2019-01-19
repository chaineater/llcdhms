<?php

namespace App\Http\Controllers;

use App\Patients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientsController extends Controller
{
    public function getAllPatients() {
        $data = Patients::all();

        return response()->json($data);
    }

    public function addPatient(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'guardian' => 'required',
            'dob' => 'required',
            'age' => 'required',
            'status' => 'required',
            'religion' => 'required',
            'contact_number' => 'required',
        ]);

        $last = DB::table('patients')->latest('id')->first();

        $pid = !$last ? 'PID_00000000' : $last->pid;
        $pid++;


        $data  = new Patients;
        $data->pid = $pid;
        $data->name = request('name');
        $data->address = request('address');
        $data->gender = request('gender');
        $data->guardian = request('guardian');
        $data->dob = request('dob');
        $data->age = request('age');
        $data->status = request('status');
        $data->religion = request('religion');
        $data->contact_number = (int)request('contact_number');
        $data->save();
    }

    public function getPatient () {
        $data = Patients::where('pid', request('pid'))->get();

        return response()->json($data);
    }
}
