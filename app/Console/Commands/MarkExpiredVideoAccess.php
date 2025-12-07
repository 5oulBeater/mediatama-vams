<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VideoAccess;
use Carbon\Carbon;

class MarkExpiredVideoAccess extends Command
{
    protected $signature = 'video:check-expiration';
    protected $description = 'Update video access status when expired';

    public function handle()
    {
        $expired = VideoAccess::where('status', 'approved')
            ->where('end_time', '<=', Carbon::now())
            ->update(['status' => 'expired']);

        $this->info("Expired access updated: $expired records.");
    }
}
