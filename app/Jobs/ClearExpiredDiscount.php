<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use App\Models\ProductDiscount;

class ClearExpiredDiscount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $discounts = ProductDiscount::whereNotNull('valid_until')->whereDate('valid_until', '<', Carbon::now())->delete();
        // if($discounts->isNotEmpty()) {
        //     $ids = $discounts->pluck('id');
        //     ProductDiscount::destroy($ids->all());
        // }
    }
}
