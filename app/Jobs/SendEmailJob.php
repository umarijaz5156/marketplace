<?php

namespace App\Jobs;

use App\Mail\UserRegisterMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $mail_to;
    public $url;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $to, $url = null)
    {
        $this->data = $data;
        $this->mail_to = $to;
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new UserRegisterMail($this->data, $this->url);

        Mail::to($this->mail_to)->send($email);
    }
}
