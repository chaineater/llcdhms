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
}
