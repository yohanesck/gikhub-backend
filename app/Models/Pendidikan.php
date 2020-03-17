<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pendidikan extends Model
{
    protected $table = 'pendidikan';

    protected $primaryKey = 'pendidikan_id';
    public $timestamps = false;

    protected $fillable = [
        'pendidikan_id',
        'pendidikan_nama'
    ];

    /**
     * @return HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'pendidikan_id', 'umat_pendidikan');
    }
}
