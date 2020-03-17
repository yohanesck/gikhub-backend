<?php

namespace App\Models;

use App\Mail\UpdateHelpMail;
use App\Mail\UpdateNotificationMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class Umat extends Model
{
    protected $table = 'umat';

    protected $primaryKey = 'umat_ktp';
    public $timestamps = false;

    protected $fillable = [
        'umat_nama',
        'umat_nama_baptis',
        'umat_agama',
        'umat_tempat_lahir',
        'umat_tanggal_lahir',
        'umat_jenis_kelamin',
        'umat_suku',
        'umat_status_aktivitas_sosial',
        'umat_hubungan_keluarga',
        'umat_status_nikah',
        'umat_golongan_darah',
        'umat_pendidikan',
        'umat_cacat_tubuh',
        'umat_meninggal',
        'umat_kevikepan_id',
        'umat_paroki_id',
        'umat_wilayah_id',
        'umat_lingkungan_id',
        'umat_ktp',
        'umat_kk',
        'umat_alamat',
        'umat_kota_kab',
        'umat_kecamatan',
        'umat_kelurahan',
        'umat_handphone',
        'umat_email',
        'umat_jurusan',
        'umat_pekerjaan',
        'umat_profesi',
        'umat_keterampilan',
        'umat_tanggal_meninggal',
        'umat_buku_baptis',
        'umat_nomer_baptis',
        'umat_keuskupan_baptis',
        'umat_paroki_baptis',
        'umat_status_rumah',
        'umat_status_ekonomi',
        'foto_profil',
        'foto_kk',
        'foto_sb',
        'tgl_update'
    ];

    protected $hidden = [
        'umat_agama',
        'umat_suku',
        'umat_status_aktivitas_sosial',
        'umat_hubungan_keluarga',
        'umat_status_nikah',
        'umat_golongan_darah',
        'umat_pendidikan',
        'umat_cacat_tubuh',
        'umat_kevikepan_id',
        'umat_wilayah_id',
        'umat_lingkungan_id',
        'umat_pekerjaan',
        'umat_profesi',
        'umat_keuskupan_baptis',
        'umat_status_rumah',
        'umat_status_ekonomi'
    ];

    public function agama()
    {
        return $this->belongsTo(Agama::class, 'umat_agama', 'agama_id');
    }

    public function golonganDarah()
    {
        return $this->belongsTo(GolonganDarah::class, 'umat_golongan_darah', 'golongan_darah_id');
    }

    public function hubunganKeluarga()
    {
        return $this->belongsTo(HubunganKeluarga::class, 'umat_hubungan_keluarga', 'hubungan_keluarga_id');
    }

    public function keuskupanBaptis()
    {
        return $this->belongsTo(Keuskupan::class, 'umat_keuskupan_baptis', 'keuskupan_id');
    }

    public function kevikepan()
    {
        return $this->belongsTo(Kevikepan::class, 'umat_kevikepan_id', 'kevikepan_id');
    }

    public function lingkungan()
    {
        return $this->belongsTo(Lingkungan::class, 'umat_lingkungan_id', 'lingkungan_id');
    }

    public function parokiBaptis()
    {
        return $this->belongsTo(Paroki::class, 'umat_paroki_baptis', 'paroki_id');
    }

    public function paroki()
    {
        return $this->belongsTo(Paroki::class, 'umat_paroki_id', 'paroki_id');
    }

    public function pekerjaan()
    {
        return $this->belongsTo(Pekerjaan::class, 'umat_pekerjaan', 'pekerjaan_id');
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class, 'umat_pendidikan', 'pendidikan_id');
    }

    public function profesi()
    {
        return $this->belongsTo(Profesi::class, 'umat_profesi', 'profesi_id');
    }

    public function statusAktivitasSosial()
    {
        return $this->belongsTo(StatusAktivitasSosial::class, 'umat_status_aktivitas_sosial', 'status_aktivitas_sosial_id');
    }

    public function statusEkonomi()
    {
        return $this->belongsTo(StatusEkonomi::class, 'umat_status_ekonomi', 'status_ekonomi_id');
    }

    public function statusNikah()
    {
        return $this->belongsTo(StatusNikah::class, 'umat_status_nikah', 'status_nikah_id');
    }

    public function statusRumah()
    {
        return $this->belongsTo(StatusRumah::class, 'umat_status_rumah', 'status_rumah_id');
    }

    public function suku()
    {
        return $this->belongsTo(Suku::class, 'umat_suku', 'suku_id');
    }

    public function tuna()
    {
        return $this->belongsTo(Tuna::class, 'umat_cacat_tubuh', 'tuna_id');
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class, 'umat_wilayah_id', 'wilayah_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'umat_ktp', 'nik');
    }

    public function prepareData($data, $foto = null)
    {
        $preparedData = [];

        foreach ($this->fillable as $column) {
            if ($column != 'tgl_update' && strpos($column, 'foto') === false) {
                $preparedData[$column] = $data[$column];
            }
        }

        if (!is_null($foto)) {
            foreach ($foto as $key => $value) {
                $preparedData[$key] = $value;
            }
        }

        $preparedData['tgl_update'] = now();

        return $preparedData;
    }

    public function scopeData($query)
    {
        return $query->with([
            'agama',
            'suku',
            'statusAktivitasSosial',
            'statusNikah',
            'golonganDarah',
            'hubunganKeluarga',
            'pendidikan',
            'tuna',
            'kevikepan',
            'paroki',
            'wilayah',
            'lingkungan',
            'pekerjaan',
            'profesi',
            'keuskupanBaptis',
            'parokiBaptis',
            'statusRumah',
            'statusEkonomi',
        ]);
    }

    public function handleUploadedImages($images)
    {
        $foto = [];
        $directory = 'Foto/' . auth()->user()->nama . '-' . auth()->user()->email . '/';

        if (array_key_exists('foto_sb', $images)) {
            $extension = $images['foto_sb']->getClientOriginalExtension();
            $name = 'Surat Baptis - '. auth()->user()->nama . '.' . $extension;
            $images['foto_sb']->move($directory, $name);
            $foto['foto_sb'] = $directory.$name;
        }
        if (array_key_exists('foto_kk', $images)) {
            $extension = $images['foto_kk']->getClientOriginalExtension();
            $name = 'Kartu Keluarga - '. auth()->user()->nama . '.' . $extension;
            $images['foto_kk']->move($directory, $name);
            $foto['foto_kk'] = $directory.$name;
        }
        if (array_key_exists('foto_profil', $images)) {
            $extension = $images['foto_profil']->getClientOriginalExtension();
            $name = 'Foto Profil - '. auth()->user()->nama . '.' . $extension;
            $images['foto_profil']->move($directory, $name);
            $foto['foto_profil'] = $directory.$name;
        }

        return $foto;
    }

    /**
     * @return array
     */
    public function handlePhotoMove()
    {
        $newDirectory = 'Foto/' . auth()->user()->nama . '-' . auth()->user()->email . '/';

        $oldDirectory = explode('/', $this->foto_sb);
        $oldDirectory = $oldDirectory[0]. '/' .$oldDirectory[1];

        if (file_exists($oldDirectory))
            $oldDirectory == $newDirectory ? : rename($oldDirectory, $newDirectory);

        return $this->preparePhotoMoveData();
    }

    /**
     * @return array
     */
    public function preparePhotoMoveData()
    {
        $folder = 'Foto/' . auth()->user()->nama . '-' . auth()->user()->email . '/';
        $nama = ' - '.auth()->user()->nama . '.jpg';

        return [
            'foto_sb' => $folder . 'Surat Baptis' . $nama,
            'foto_kk' => $folder . 'Kartu Keluarga' . $nama,
            'foto_profil' => $folder . 'Foto Profil' . $nama
        ];
    }

    /**
     * @param $request
     * @param null $umat
     * @return |null
     */
    public function handleNIKVerification($request, $umat = null)
    {
        $data = null;

        if (is_null($umat)) {
            $data = $this->where('umat_ktp', $request['nik'])->where('umat_nomer_baptis', $request['nomor_baptis'])->first();
        } else {
            if ($umat->umat_ktp == auth()->user()->nik && $request['nik'] == $umat->umat_ktp) {
                $data = $umat->data()->find($request['nik']);
            }
        }

        return $data;
    }


    /**
     * Send notification update email
     *
     * @return mixed
     */
    public function sendNotificationEmail()
    {
        return Mail::to('yohanes.chris@ti.ukdw.ac.id')->send(new UpdateNotificationMail($this));
    }
}
