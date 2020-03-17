<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lingkungan extends Model
{
    protected $table = 'lingkungan';

    protected $primaryKey = 'lingkungan_id';
    public $timestamps = false;

    protected $fillable = [
        'lingkungan_id',
        'lingkungan_nama'
    ];

    /**
     * @return HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'lingkungan_id', 'umat_lingkungan_id');
    }
}
