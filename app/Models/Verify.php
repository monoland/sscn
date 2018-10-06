<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Http\Resources\VerifyResource;
use Illuminate\Database\Eloquent\Model;

class Verify extends Model
{
    // relations

    // filters
    public function scopeFilterOn($query, $request)
    {
        $sortaz = $request->descending === 'true' ? 'desc' : 'asc';
        $sortby = $request->has('sortBy') ? $request->sortBy : null;
        $filter = $request->has('filter') ? $request->filter : null;

        $mixquery = $query;

        if ($filter) {
            $mixquery = $mixquery->where('name', 'like', "%{$filter}%");
        }

        if ($sortby) {
            $mixquery = $mixquery->orderBy($sortby, $sortaz);
        }

        return $mixquery;
    }

    // import
    public static function importRecord($request)
    {
        DB::beginTransaction();

        try {
            $model = new static;
            $model->nik = $request->nik;
            $model->name = $request->nama;
            $model->diploma_name = $request->nama_ijazah;
            $model->register_numb = $request->no_register;
            $model->participant_numb = $request->no_peserta === 'null' ? null : $request->no_peserta;
            $model->position_code = $request->kode_jabatan;
            $model->position_name = $request->jabatan;
            $model->location_name = $request->lokasi_kerja;
            $model->domicile = $request->domisili;
            $model->formation_type = $request->jenis_formasi;
            $model->education_code = $request->kode_pendidikan;
            $model->education_name = $request->pendidikan;
            $model->gender = $request->jenis_kelamin;
            $model->verification_name = $request->verifikator;
            $model->testloc_code = $request->kode_lokasi_ujian === 'null' ? null : $request->kode_lokasi_ujian;
            $model->testloc_name = $request->lokasi_ujian === 'null' ? null : $request->lokasi_ujian;
            $model->verification_date = $request->tanggal_verifikasi;
            $model->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    // store
    public static function storeRecord($request)
    {
        DB::beginTransaction();

        try {
            $model = new static;
            // ...
            $model->save();

            DB::commit();

            return new VerifyResource($model);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    // update
    public static function updateRecord($request, $model)
    {
        DB::beginTransaction();

        try {
            // ...
            $model->save();

            DB::commit();

            return new VerifyResource($model);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    // delete
    public static function destroyRecord($model)
    {
        DB::beginTransaction();

        try {
            $model->delete();

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }

    // bulks
    public static function bulksRecord($request, $model = null)
    {
        DB::beginTransaction();

        try {
            $bulks = array_column($request->all(), 'id');
            $rests = (new static)->whereIn('id', $bulks)->delete();

            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }
}
