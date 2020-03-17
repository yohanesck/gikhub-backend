<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GolonganDarah extends Model
{
    protected $table = 'golongan_darah';

    protected $primaryKey = 'golongan_darah_id';
    public $timestamps = false;

    protected $fillable = [
        'golongan_darah_id',
        'golongan_darah_nama'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'golongan_darah_id', 'umat_golongan_darah');
    }
}
