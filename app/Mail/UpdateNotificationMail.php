<?php

namespace App\Mail;

use App\Models\Umat;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    private $umat;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Umat $umat)
    {
        $this->umat = $umat;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $umat = $this->umat->data()->find(auth()->user()->nik);

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->markdown('mail.notification')
            ->subject('Notifikasi Pembaruan Data Umat ' . $umat['tgl_update'])
            ->with([
                'nama' => $umat['umat_nama'],
                'telepon' => $umat['umat_handphone'],
                'tanggalUpdate' => date('d-m-Y H:i:s', strtotime($umat['tgl_update']))
            ]);
    }
}
