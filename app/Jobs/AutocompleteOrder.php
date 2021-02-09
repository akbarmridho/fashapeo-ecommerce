<?php

namespace App\Jobs;

use App\Actions\Order\UpdateStatus;
use App\Events\OrderCompleted;
use App\Models\Order;
use App\Services\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class AutocompleteOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $status;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(OrderStatus $status)
    {
        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $activeOrders = Order::whereNotNull('completed_at')->get();

        foreach ($activeOrders as $order) {
            if ($order->updated_at->greaterThan(Carbon::now()->subDays(30))) {
                if ($order->shipment->tracking_order) {
                    $this->status->orderCompleted($order);
                } else {
                    $this->status->orderExpired($order);
                }
            }
        }
    }
}
