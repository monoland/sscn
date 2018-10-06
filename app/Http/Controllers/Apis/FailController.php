<?php

namespace App\Http\Controllers\Apis;

use App\Models\Fail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\FailCollection;
use App\Http\Controllers\Controller;

class FailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new FailCollection(
            Fail::filterOn($request)->paginate($request->rowsPerPage)
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

        return Fail::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fail  $fail
     * @return \Illuminate\Http\Response
     */
    public function show(Fail $fail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fail  $fail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fail $fail)
    {
        $this->validate($request, [
            //
        ]);

        return Fail::updateRecord($request, $fail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fail  $fail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fail $fail)
    {
        return Fail::destroyRecord($fail);
    }

    /**
     * Remove the bulks resource from storage.
     *
     * @param  \App\Models\Fail  $fail
     * @return \Illuminate\Http\Response
     */
    public function bulks(Request $request)
    {
        return Fail::bulksRecord($request);
    }

    public function import(Request $request, $filename)
    {
        Fail::query()->truncate();

        $records = Excel::selectSheets('Sheet1')->load(
            'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $filename
        )->toObject();

        foreach ($records as $record) {
            if ($record->nik) {
                Fail::importRecord($record);
            }
        }

        return response()->json([
            'success' => true
        ]);
    }
}
