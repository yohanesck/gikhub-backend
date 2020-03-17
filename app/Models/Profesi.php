<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profesi extends Model
{
    protected $table = 'profesi';

    protected $primaryKey = 'profesi_id';
    public $timestamps = false;

    protected $fillable = [
        'profesi_id',
        'profesi_nama'
    ];

    /**
     * @return HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'profesi_id', 'umat_profesi');
    }
}
