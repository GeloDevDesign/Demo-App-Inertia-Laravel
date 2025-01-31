<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Models\Logs;

class LogsController extends Controller
{
    public function index()
    {
        //
        return Inertia::render(
            'Views/Logs/index'
        );
    }
}
