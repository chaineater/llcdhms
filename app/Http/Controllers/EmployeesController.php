<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->user = \Auth::user();
    }

    public function getAllEmployees() {
        $data = User::all();

        return response()->json($data);
    }

    public function addEmployee() {
        $last = DB::table('users')->latest('id')->first();

        $last_user_id = $last->user_id;
        $last_user_id++;

        $data = new User;
        $data->name = request('name');
        $data->email = request('email');
        $data->user_type = request('userType');
        $data->user_id = $last_user_id;
        $data->status = 'Active';
        $data->password = bcrypt('default');
        $data->save();

        return response()->json($data);
    }

    public function removeEmployee() {
        $data = User::findOrFail(request('id'))->delete();
    }

    public function deactivateEmployee() {
        $data = User::findOrFail(request('id'))->update(['status' => 'Inactive']);
    }

    public function activateEmployee() {
        $data = User::findOrFail(request('id'))->update(['status' => 'Active']);
    }
}
