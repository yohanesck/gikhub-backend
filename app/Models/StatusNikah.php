<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StatusNikah extends Model
{
    protected $table = 'status_nikah';

    protected $primaryKey = 'status_nikah_id';
    public $timestamps = false;

    protected $fillable = [
        'status_nikah_id',
        'status_nikah_nama'
    ];

    /**
     * @return HasMany
     */
    public function umat()
    {
        return $this->hasMany(Umat::class, 'status_nikah_id', 'umat_status_nikah');
    }
}
