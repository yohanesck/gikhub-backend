<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table = 'wilayah';

    protected $primaryKey = 'wilayah_id';
    public $timestamps = false;

    protected $fillable = [
        'wilayah_id',
        'wilayah_nama'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'wilayah_id', 'umat_wilayah');
    }
}
