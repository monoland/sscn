<?php

namespace App\Http\Controllers\Apis;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Resources\ScheduleCollection;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new ScheduleCollection(
            Schedule::filterOn($request)->paginate($request->rowsPerPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            //
        ]);

        return Schedule::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $this->validate($request, [
            //
        ]);

        return Schedule::updateRecord($request, $schedule);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        return Schedule::destroyRecord($schedule);
    }

    /**
     * Remove the bulks resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function bulks(Request $request)
    {
        return Schedule::bulksRecord($request);
    }

    public function import(Request $request, $filename)
    {
        Schedule::query()->truncate();

        $records = Excel::selectSheets('Sheet1')->load(
            'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $filename
        )->toObject();

        foreach ($records as $record) {
            if ($record->no_register) {
                Schedule::importRecord($record);
            }
        }

        return response()->json([
            'success' => true
        ]);
    }
}
