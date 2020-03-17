<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusEkonomi extends Model
{
    protected $table = 'status_ekonomi';

    protected $primaryKey = 'status_ekonomi_id';
    public $timestamps = false;

    protected $fillable = [
        'status_ekonomi_id',
        'status_ekonomi_nama'
    ];

    /**
     * @return HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'status_ekonomi_id', 'umat_status_ekonomi');
    }
}
