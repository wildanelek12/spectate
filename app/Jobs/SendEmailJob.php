<?php

namespace App\Jobs;

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

    public $receipt_email;
    public $mail_model;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($receipt_email, $mail_model)
    {
        $this->receipt_email = $receipt_email;
        $this->mail_model = $mail_model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->receipt_email)->send($this->mail_model);
    }
}
