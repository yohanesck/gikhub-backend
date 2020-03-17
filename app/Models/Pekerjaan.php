<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table = 'pekerjaan';

    protected $primaryKey = 'pekerjaan_id';
    public $timestamps = false;

    protected $fillable = [
        'pekerjaan_id',
        'pekerjaan_nama'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'pekerjaan_id', 'umat_pekerjaan');
    }
}
