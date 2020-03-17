<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Suku extends Model
{
    protected $table = 'suku';

    protected $primaryKey = 'suku_id';
    public $timestamps = false;

    protected $fillable = [
        'suku_id',
        'suku_nama'
    ];

    /**
     * @return HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'suku_id', 'umat_suku');
    }
}
