<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusRumah extends Model
{
    protected $table = 'status_rumah';

    protected $primaryKey = 'status_rumah_id';
    public $timestamps = false;

    protected $fillable = [
        'status_rumah_id',
        'status_rumah_nama'
    ];

    /**
     * @return HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'status_rumah_id', 'umat_status_rumah');
    }
}
