<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusAktivitasSosial extends Model
{
    protected $table = 'status_aktivitas_sosial';

    protected $primaryKey = 'status_aktivitas_sosial_id';
    public $timestamps = false;

    protected $fillable = [
        'status_aktivitas_sosial_id',
        'status_aktivitas_sosial_nama'
    ];

    /**
     * @return HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'status_aktivitas_sosial_id', 'umat_status_aktivitas_sosial');
    }
}
