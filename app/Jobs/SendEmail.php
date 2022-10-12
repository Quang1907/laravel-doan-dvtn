<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( User $user )
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;
        Mail::send( "client.auth.email", compact( "user" ), function ( $email ) use ( $user ) {
            $email->subject( "Đoàn viên thanh niên - xác nhận tài khoản" );
            $email->to( $user->email, $user->name );
        });
    }
}
