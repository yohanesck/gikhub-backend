<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tuna extends Model
{
    protected $table = 'tuna';

    protected $primaryKey = 'tuna_id';
    public $timestamps = false;

    protected $fillable = [
        'tuna_id',
        'tuna_nama'
    ];

    /**
     * @return HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'tuna_id', 'umat_cacat_tubuh');
    }
}
