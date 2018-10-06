<?php

namespace App\Http\Controllers\Apis;

use App\Models\Verify;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\VerifyCollection;
use App\Http\Controllers\Controller;

class VerifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new VerifyCollection(
            Verify::filterOn($request)->paginate($request->rowsPerPage)
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

        return Verify::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Verify  $verify
     * @return \Illuminate\Http\Response
     */
    public function show(Verify $verify)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Verify  $verify
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verify $verify)
    {
        $this->validate($request, [
            //
        ]);

        return Verify::updateRecord($request, $verify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Verify  $verify
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verify $verify)
    {
        return Verify::destroyRecord($verify);
    }

    /**
     * Remove the bulks resource from storage.
     *
     * @param  \App\Models\Verify  $verify
     * @return \Illuminate\Http\Response
     */
    public function bulks(Request $request)
    {
        return Verify::bulksRecord($request);
    }

    public function import(Request $request, $filename)
    {
        Verify::query()->truncate();

        $records = Excel::selectSheets('Sheet1')->load(
            'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $filename
        )->toObject();

        foreach ($records as $record) {
            if ($record->nik) {
                Verify::importRecord($record);
            }
        }

        return response()->json([
            'success' => true
        ]);
    }
}
