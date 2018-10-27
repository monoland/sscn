<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Http\Resources\ScheduleResource;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
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
            $model->participant_numb = $request->no_peserta;
            $model->register_id = $request->no_register;
            $model->name = $request->nama;
            $model->exam_date = $request->tanggal_ujian;
            $model->exam_time = $request->jam;
            $model->sesi = $request->sesi;
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

            return new ScheduleResource($model);
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

            return new ScheduleResource($model);
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
