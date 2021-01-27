<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use App\Models\Order;
use App\Repository\StatusRepositoryInterface as StatusRepository;
use App\Actions\Order\UpdateStatus;
use App\Events\OrderCompleted;

class AutocompleteOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $status;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(StatusRepository $status)
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

        foreach($activeOrders as $order)
        {
            if($order->updated_at->greaterThan(Carbon::now()->subDays(30))) {

                if($order->recentStatus()->is($this->status->orderShipped())) {

                    (new UpdateStatus)->update($order, $this->status->orderCompleted());
                    event(new OrderCompleted($order));

                } else {
                    (new UpdateStatus)->update($order, $this->status->orderExpired());
                }

                $order->fill(['completed_at' => Carbon::now()])->save();
            } 
        }
    }
}
