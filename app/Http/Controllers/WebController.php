<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Resources\ScheduleCollection;

class WebController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function schedule()
    {
        return view('exam');
    }

    public function exam(Request $request)
    {
        return new ScheduleCollection(
            Schedule::filterOn($request)->paginate($request->rowsPerPage)
        );
    }
}
