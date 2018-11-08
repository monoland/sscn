<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    public static function importRecord($request)
    {
        DB::beginTransaction();

        try {
            $total = $request->twk + $request->tiu + $request->tkp;

            if ($request->twk >= 75 && $request->tiu >= 80 && $request->tkp >= 143) {
                $status = 1;
            } else {
                $status = 0;
            }

            $model = new static;
            $model->participant_numb = $request->no_peserta;
            $model->twk = $request->twk;
            $model->tiu = $request->tiu;
            $model->tkp = $request->tkp;
            $model->total = $total;
            $model->status = $status;
            $model->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            abort(500, $e->getMessage());
        }
    }
}
