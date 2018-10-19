<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Http\Resources\RegisterResource;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    // relations

    // filters
    public function scopeOnDate($query, $date)
    {
        $date = strtotime($date);
        return $query->whereDate('register_date', date('Y-m-d', $date));
    }

    public function scopeForTimeline($query)
    {
        return $query
            ->selectRaw('register_date, gender, count(gender) as summary')
            ->groupBy('register_date', 'gender')
            ->orderBy('register_date')
            ->orderBy('gender')
            ->get();
    }

    public function scopeForSummary($query)
    {
        return $query
            ->selectRaw('verification_status as status, count(verification_status) as summary')
            ->groupBy('verification_status')
            ->get();
    }

    public function scopeFormationRecap($query)
    {
        return $query
            ->selectRaw("formation_type, verification_status, count(*) as summary, count(*) FILTER (WHERE gender = 'PEREMPUAN') as p, count(*) FILTER (WHERE gender='LAKI-LAKI') as l")
            ->groupBy('formation_type', 'verification_status')
            ->orderBy('formation_type');
    }

    public function scopeFilterOn($query, $request)
    {
        $sortaz = $request->descending === 'true' ? 'desc' : 'asc';
        $sortby = $request->has('sortBy') ? $request->sortBy : null;
        $filter = $request->has('filter') ? $request->filter : null;

        $mixquery = $query;

        if ($filter) {
            // $mixquery = $mixquery->where('name', 'like', "%{$filter}%");
            $mixquery = $mixquery->whereRaw('lower(name) like ?', ["%{$filter}%"])
                            ->orWhereRaw('register_numb = ?', ["{$filter}"]);
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
            $model->register_numb = $request->no_register;
            $model->register_date = $request->tanggal_daftar;
            $model->account_date = $request->tanggal_buat_akun;
            $model->participant_numb = $request->nomor_peserta;
            $model->name = $request->nama;
            $model->diploma_name = $request->nama_ijazah;
            $model->born_place = $request->tempat_lahir;
            $model->born_date = $request->tanggal_lahir;
            $model->diploma_born_place = $request->tempat_lahir_ijazah;
            $model->diploma_born_date = $request->tanggal_lahir_ijazah;
            $model->gender = $request->jenis_kelamin;
            $model->institution = $request->asal_institusi_pendidikan;
            $model->diploma_numb = $request->no_ijazah;
            $model->credit_institution = $request->akreditasi_lembaga;
            $model->credit_prodi = $request->akreditasi_prodi;
            $model->ipk = $request->nilai_ipk;
            $model->location_code = $request->kode_lokasi;
            $model->location_name = $request->nama_lokasi;
            $model->position_code = $request->kode_jabatan;
            $model->position_name = $request->nama_jabatan;
            $model->education_code = $request->kode_pendidikan;
            $model->education_name = $request->nama_pendidikan;
            $model->formation_type = $request->jenis_formasi;
            $model->verification_status = $request->siap_verifikasi;
            $model->testloc_code = $request->kode_lokasi_ujian;
            $model->testloc_name = $request->lokasi_ujian;
            $model->exam_k2_numb = $request->no_peserta_ujian_k2 === 'null' ? null : $request->no_peserta_ujian_k2;
            $model->exam_certification_numb = $request->no_peserta_sertifikasi_guru === 'null' ? null : $request->no_peserta_sertifikasi_guru;
            $model->str_numb = $request->no_str === 'null' ? null : $request->no_str;
            $model->str_date = $request->tgl_berlaku_str === 'null' ? null : $request->tgl_berlaku_str;
            $model->toefl = $request->toefl === 'null' ? null : $request->toefl;
            $model->toefl_type = $request->jenis_toefl === 'null' ? null : $request->jenis_toefl;
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

            return new RegisterResource($model);
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

            return new RegisterResource($model);
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
