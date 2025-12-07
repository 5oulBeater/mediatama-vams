<?php

namespace App\Jobs;

use App\Models\VideoAccess;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CheckVideoExpirationJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function handle(): void
    {
        VideoAccess::where('status', 'approved')
            ->where('end_time', '<=', now())
            ->update(['status' => 'expired']);
    }
}
