<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function getAllHistory() {
        $data = History::all();

        return response()->json($data);
    }

    public function createHistory () {
        $data = new History;
        $data->history_type = request('history_type');
        $data->action_taken = request('action_taken');
        $data->created_by = request('created_by');
        $data->save();
    }
}
