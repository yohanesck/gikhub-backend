<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HubunganKeluarga extends Model
{
    protected $table = 'hubungan_keluarga';

    protected $primaryKey = 'hubungan_keluarga_id';
    public $timestamps = false;

    protected $fillable = [
        'hubungan_keluarga_id',
        'hubungan_keluarga_nama'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'hubungan_keluarga_id', 'umat_hubungan_keluarga');
    }
}
