<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kevikepan extends Model
{
    protected $table = 'kevikepan';

    protected $primaryKey = 'kevikepan_id';
    public $timestamps = false;

    protected $fillable = [
        'kevikepan_id',
        'kevikepan_nama'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'kevikepan_id', 'umat_kevikepan_id');
    }
}
