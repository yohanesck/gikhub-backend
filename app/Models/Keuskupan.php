<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuskupan extends Model
{
    protected $table = 'keuskupan';

    protected $primaryKey = 'keuskupan_id';
    public $timestamps = false;

    protected $fillable = [
        'keuskupan_id',
        'keuskupan_nama'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'keuskupan_id', 'umat_keuskupan_baptis');
    }
}
