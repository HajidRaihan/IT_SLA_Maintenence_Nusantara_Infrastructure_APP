<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function show() {
        $data = [
            'title' => 'Welcome to My Website',
            'content' => 'This is a simple example of integrating Laravel template with React frontend.',
        ];
        return response()->json($data);
    }
}
