<?php

namespace App\Http\Controllers\Apis;

use App\Models\Recap;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\RecapCollection;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecapSummaryResource;

class RecapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new RecapCollection(
            Recap::filterOn($request)->paginate($request->rowsPerPage)
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

        return Recap::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recap  $recap
     * @return \Illuminate\Http\Response
     */
    public function show(Recap $recap)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recap  $recap
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recap $recap)
    {
        $this->validate($request, [
            //
        ]);

        return Recap::updateRecord($request, $recap);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recap  $recap
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recap $recap)
    {
        return Recap::destroyRecord($recap);
    }

    /**
     * Remove the bulks resource from storage.
     *
     * @param  \App\Models\Recap  $recap
     * @return \Illuminate\Http\Response
     */
    public function bulks(Request $request)
    {
        return Recap::bulksRecord($request);
    }

    public function import(Request $request, $filename)
    {
        Recap::query()->truncate();

        $records = Excel::selectSheets('Sheet1')->load(
            'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $filename
        )->toObject();

        foreach ($records as $record) {
            if ($record->kode_instansi) {
                Recap::importRecord($record);
            }
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function summary(Request $request)
    {
        return new RecapSummaryResource(Recap::byType());
    }
}
