<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $table = 'agama';

    protected $primaryKey = 'agama_id';
    public $timestamps = false;

    protected $fillable = [
        'agama_id',
        'agama_nama'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'agama_id', 'umat_agama');
    }
}
