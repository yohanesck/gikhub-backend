<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\GolonganDarah;
use App\Models\HubunganKeluarga;
use App\Models\Keuskupan;
use App\Models\Kevikepan;
use App\Models\Lingkungan;
use App\Models\Paroki;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\Profesi;
use App\Models\StatusAktivitasSosial;
use App\Models\StatusEkonomi;
use App\Models\StatusNikah;
use App\Models\StatusRumah;
use App\Models\Suku;
use App\Models\Tuna;
use App\Models\Wilayah;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class MasterDataController
 *
 * Controller for all master data
 *
 * @package App\Http\Controllers
 */
class MasterDataController extends Controller
{
    private $agama, $golonganDarah, $hubunganKeluarga, $keuskupan, $kevikepan, $lingkungan, $paroki, $pekerjaan, $pendidikan, $profesi, $statusAktivitasSosial, $statusEkonomi, $statusNikah, $statusRumah, $suku, $tuna, $wilayah;

    /**
     * MasterDataController constructor.
     * @param Agama $agama
     * @param GolonganDarah $golonganDarah
     * @param HubunganKeluarga $hubunganKeluarga
     * @param Keuskupan $keuskupan
     * @param Kevikepan $kevikepan
     * @param Lingkungan $lingkungan
     * @param Paroki $paroki
     * @param Pekerjaan $pekerjaan
     * @param Pendidikan $pendidikan
     * @param Profesi $profesi
     * @param StatusAktivitasSosial $statusAktivitasSosial
     * @param StatusEkonomi $statusEkonomi
     * @param StatusNikah $statusNikah
     * @param StatusRumah $statusRumah
     * @param Suku $suku
     * @param Tuna $tuna
     * @param Wilayah $wilayah
     */
    public function __construct(
        Agama $agama,
        GolonganDarah $golonganDarah,
        HubunganKeluarga $hubunganKeluarga,
        Keuskupan $keuskupan,
        Kevikepan $kevikepan,
        Lingkungan $lingkungan,
        Paroki $paroki,
        Pekerjaan $pekerjaan,
        Pendidikan $pendidikan,
        Profesi $profesi,
        StatusAktivitasSosial $statusAktivitasSosial,
        StatusEkonomi $statusEkonomi,
        StatusNikah $statusNikah,
        StatusRumah $statusRumah,
        Suku $suku,
        Tuna $tuna,
        Wilayah $wilayah
    )
    {
        $this->agama = $agama;
        $this->golonganDarah = $golonganDarah;
        $this->hubunganKeluarga = $hubunganKeluarga;
        $this->keuskupan = $keuskupan;
        $this->kevikepan = $kevikepan;
        $this->lingkungan = $lingkungan;
        $this->paroki = $paroki;
        $this->pekerjaan = $pekerjaan;
        $this->pendidikan = $pendidikan;
        $this->profesi = $profesi;
        $this->statusAktivitasSosial = $statusAktivitasSosial;
        $this->statusEkonomi = $statusEkonomi;
        $this->statusNikah = $statusNikah;
        $this->statusRumah = $statusRumah;
        $this->suku = $suku;
        $this->tuna = $tuna;
        $this->wilayah = $wilayah;
    }

    /**
     * Get all data from master data
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json([
            'agama' => $this->agama->get(),
            'golongan_darah' => $this->golonganDarah->get(),
            'hubungan_keluarga' => $this->hubunganKeluarga->get(),
            'keuskupan' => $this->keuskupan->get(),
            'kevikepan' => $this->kevikepan->get(),
            'lingkungan' => $this->lingkungan->get(),
            'paroki' => $this->paroki->get(),
            'pekerjaan' => $this->pekerjaan->get(),
            'pendidikan' => $this->pendidikan->get(),
            'profesi' => $this->profesi->get(),
            'status_aktivitas_sosial' => $this->statusAktivitasSosial->get(),
            'status_ekonomi' => $this->statusEkonomi->get(),
            'status_nikah' => $this->statusNikah->get(),
            'status_rumah' => $this->statusRumah->get(),
            'suku' => $this->suku->get(),
            'tuna' => $this->tuna->get(),
            'wilayah' => $this->wilayah->get()
        ], 200);
    }
}
