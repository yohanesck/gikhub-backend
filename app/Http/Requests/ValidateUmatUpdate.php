<?php

namespace App\Http\Requests;

use App\Exceptions\DuplicateEmailException;
use App\Exceptions\DuplicateKTPException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ValidateUmatUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'umat_nama' => 'required',
            'umat_nama_baptis' => 'required',
            'umat_agama' => 'required',
            'umat_tempat_lahir' => 'required',
            'umat_tanggal_lahir' => 'required',
            'umat_jenis_kelamin' => 'required',
            'umat_suku' => 'required',
            'umat_status_aktivitas_sosial' => 'required',
            'umat_hubungan_keluarga' => 'required',
            'umat_status_nikah' => 'required',
            'umat_golongan_darah' => 'required',
            'umat_pendidikan' => 'required',
            'umat_cacat_tubuh' => 'required',
            'umat_meninggal' => 'required',
            'umat_kevikepan_id' => 'required',
            'umat_paroki_id' => 'required',
            'umat_wilayah_id' => 'required',
            'umat_lingkungan_id' => 'required',
            'umat_ktp' => 'required|size:16|unique:umat,umat_ktp,' . $this->user()->nik . ',umat_ktp',
            'umat_kk' => 'required|size:16',
            'umat_alamat' => 'required',
            'umat_kota_kab' => 'required',
            'umat_kecamatan' => 'required',
            'umat_kelurahan' => 'required',
            'umat_handphone' => 'required:max:13',
            'umat_email' => 'email:rfc,dns',
            'umat_jurusan' => 'required',
            'umat_pekerjaan' => 'required',
            'umat_profesi'=> 'required',
            'umat_keterampilan' => 'required',
            'umat_tanggal_meninggal'=> 'required_if:umat_meninggal,1',
            'umat_buku_baptis' => 'required',
            'umat_nomer_baptis' => 'required',
            'umat_keuskupan_baptis' => 'required',
            'umat_paroki_baptis' => 'required',
            'umat_status_rumah' => 'required',
            'umat_status_ekonomi' => 'required',
            'foto_profil' => 'nullable',
            'foto_kk' => 'nullable',
            'foto_sb' => 'nullable',
            'tgl_update' => 'nullable'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if (array_key_exists('umat_ktp', $validator->errors()->toArray()))
            if (in_array('The umat ktp has already been taken.', $validator->errors()->toArray()['umat_ktp']))
                throw new DuplicateKTPException();

        parent::failedValidation($validator); // TODO: Change the autogenerated stub
    }
}