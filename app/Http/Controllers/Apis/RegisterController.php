<?php

namespace App\Http\Controllers\Apis;

use App\Models\Register;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\RegisterCollection;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new RegisterCollection(
            Register::filterOn($request)->paginate($request->rowsPerPage)
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

        return Register::storeRecord($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function show(Register $register)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Register $register)
    {
        $this->validate($request, [
            //
        ]);

        return Register::updateRecord($request, $register);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function destroy(Register $register)
    {
        return Register::destroyRecord($register);
    }

    /**
     * Remove the bulks resource from storage.
     *
     * @param  \App\Models\Register  $register
     * @return \Illuminate\Http\Response
     */
    public function bulks(Request $request)
    {
        return Register::bulksRecord($request);
    }

    public function import(Request $request, $filename)
    {
        $first = true;

        $records = Excel::selectSheets('Sheet1')->load(
            'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $filename
        )->toObject();

        foreach ($records as $record) {
            if ($record->nik) {
                if ($first) {
                    if (Register::onDate($record->tanggal_daftar)->count() > 0) {
                        Register::onDate($record->tanggal_daftar)->delete();
                    }

                    $first = false;
                }

                Register::importRecord($record);
            }
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function summary(Request $request)
    {
        $records = Register::forSummary();

        $labels = [];
        $data = [];

        foreach ($records as $record) {
            array_push($labels, str_replace(' Verifikasi', '', $record->status));
            array_push($data, $record->summary);
        }

        return response()->json([
            'labels' => $labels,

            'datasets' => [
                [
                    'data' => $data,
                    'backgroundColor' => ['#FFC107', '#F44336', '#90A4AE', '#4CAF50']
                ]
            ]
        ]);
    }

    public function timeline(Request $request)
    {
        $records = Register::forTimeline()->groupBy('register_date')->toArray();

        $labels = [];
        $data1 = [];
        $data2 = [];

        foreach ($records as $tgl => $datas) {
            $tanggal = strtotime($tgl);
            $tanggal = date('d/m', $tanggal);
            array_push($labels, $tanggal);

            foreach ($datas as $record) {
                if ($record['gender'] === 'LAKI-LAKI') {
                    array_push($data1, $record['summary']);
                } else {
                    array_push($data2, $record['summary']);
                }
            }
        }

        return response()->json([
            'labels' => $labels,

            'datasets' => [
                [
                    'label' => 'LAKI-LAKI',
                    'fill' => true,
                    'data' => $data1,
                    'borderWidth' => 1,
                    'borderColor' => 'rgb(0, 145, 249)',
                    'backgroundColor' => 'rgba(0, 145, 249, 0.2)',
                    'lineTension' => 0
                ],

                [
                    'label' => 'PEREMPUAN',
                    'fill' => true,
                    'data' => $data2,
                    'borderWidth' => 1,
                    'borderColor' => 'rgb(255, 0, 93)',
                    'backgroundColor' => 'rgba(255, 0, 93, 0.2)',
                    'lineTension' => 0
                ]
            ]
        ]);
    }

    public function formation(Request $request)
    {
        return Register::formationRecap()->get();
    }

    public function resultcheck(Request $request)
    {
        return Register::resultCheck($request);
    }

    public function download(Request $request, $registrar)
    {
        $record = Register::find($registrar);

        return view('print', compact('record'));
    }
}
