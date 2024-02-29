<?php

namespace App\Jobs;

use App\Models\Worker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWelcomeEmail implements ShouldQueue
{

    private Worker $worker;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(Worker $worker)
    {
        $this->worker = $worker;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send welcome email to $this->worker
        var_dump('Send welcome email to ' . $this->worker->email);
    }
}
