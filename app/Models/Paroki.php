<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paroki extends Model
{
    protected $table = 'paroki';

    protected $primaryKey = 'paroki_id';
    public $timestamps = false;

    protected $fillable = [
        'paroki_id',
        'paroki_nama'
    ];

    /**
     * @return HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'paroki_id', 'umat_paroki_id');
    }

    public function umatBaptis()
    {
        return $this->hasMany(Umat::class, 'paroki_id', 'umat_paroki_baptis');
    }
}
