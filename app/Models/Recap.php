<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Http\Resources\RecapResource;
use Illuminate\Database\Eloquent\Model;

class Recap extends Model
{
    // relations

    // filters
    public function scopeByType($query)
    {
        return $query
            ->selectRaw('type, sum(formation) as formation, sum(registrar) as registrar')
            ->groupBy('type')
            ->orderBy('type')
            ->get();
    }

    public function scopeFilterOn($query, $request)
    {
        $sortaz = $request->descending === 'true' ? 'desc' : 'asc';
        $sortby = $request->has('sortBy') ? $request->sortBy : null;
        $filter = $request->has('filter') ? $request->filter : null;

        $mixquery = $query;

        if ($filter) {
            $mixquery = $mixquery->whereRaw('lower(location) like ?', ["%{$filter}%"]);
            // where('name', 'like', "%{$filter}%");
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
            $model->code = $request->kode_instansi;
            $model->name = $request->instansi;
            $model->type = $request->jenis_formasi;
            $model->position = $request->jabatan;
            $model->location = $request->lokasi;
            $model->education = $request->pendidikan;
            $model->formation = $request->jumlah_formasi;
            $model->registrar = $request->jumlah_pendaftar;
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

            return new RecapResource($model);
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

            return new RecapResource($model);
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
