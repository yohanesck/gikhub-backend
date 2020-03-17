<?php

namespace App\Models;

use App\Mail\ForgotPasswordMail;
use App\Mail\UpdateHelpMail;
use App\Mail\UpdateNotificationMail;
use App\Notifications\PasswordResetEmailNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    public $timestamps = false;
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'client_id',
        'nik',
        'nomor_telepon'
    ];

    protected $hidden = [
        'password'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }

    public function prepareDataInsert($data)
    {
        return [
            is_null($data['nama']) ?  : 'nama' => $data['nama'],
            'password' => bcrypt($data['password']),
            is_null($data['email']) ?  : 'email' => $data['email'],
            'client_id' => $data['client_id'],
            'nik' => $data['nik'],
            'nomor_telepon' => $data['nomor_telepon']
        ];
    }

    /**
     * Return an array of data to be inserted to database
     *
     * @param $data
     * @return array
     */
    public function prepareDataUpdate($data)
    {
        return [
            is_null($data['nama']) ?  : 'nama' => $data['nama'],
            is_null($data['password']) ? : 'password' => bcrypt($data['password']),
            is_null($data['email']) ?  : 'email' => $data['email'],
            is_null($data['client_id']) ? :'client_id' => $data['client_id'],
            is_null($data['nik']) ? :'nik' => $data['nik'],
            is_null($data['nomor_telepon']) ?  : 'nomor_telepon' => $data['nomor_telepon']
        ];
    }

    /**
     * Return current user data
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->get();
    }

    public function umat()
    {
        return $this->hasOne(Umat::class, 'umat_ktp', 'nik');
    }

    /**
     * Return data with foto_profil field
     *
     * @param $query
     * @return mixed
     */
    public function scopeProfilePhoto($query)
    {
        return $query->with(['umat:umat_ktp,foto_profil']);
    }


    /**
     * Send request for help manual update email
     *
     * @return mixed
     */
    public function sendHelpUpdateEmail()
    {
        return Mail::to('yohanes.chris@ti.ukdw.ac.id')->send(new UpdateHelpMail($this));
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetEmailNotification($token));
    }
}
