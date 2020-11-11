<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        return Event::all();
    }

    public function save (Request $request) 
    {
        $data = $request->only(['name', 'date_to', 'date_from', 'days']);
        $saveData = Event::create([
            'days' => $data['days'],
            'name' => $data['name'],
            'date_to' => $data['date_to'],
            'date_from' => $data['date_from']
        ]);
        return response()->json($saveData);
    }
}
