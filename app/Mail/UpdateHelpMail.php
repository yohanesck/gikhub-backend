<?php

namespace App\Mail;

use App\Models\Umat;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateHelpMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user->find(auth()->id());

        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->markdown('mail.help')
            ->subject('Permohonan Bantuan Pembaruan Data Umat Manual ' . now(7))
            ->with([
                'nama' => $user['nama'],
                'telepon' => $user['nomor_telepon']
            ]);
    }
}
