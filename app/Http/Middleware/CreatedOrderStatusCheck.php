<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Repository\StatusRepositoryInterface as Status;
use App\Exceptions\CannotValidateOrder;
use App\Exceptions\CannotValidateStatus;

class CreatedOrderStatusCheck
{
    private $status;

    public function __construct(Status $status)
    {
        $this->status = $status;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $current)
    {
        $order = Order::where('order_number', $request->route('order'))->firstOrFail();
        if(! $orderStatus = $order->recent_status) {
            throw new CannotValidateStatus();
        }

        switch($current)
        {
            case 'shipment':
                $expectedStatus = $this->status->orderCreated();
                break;
            case 'transaction':
                $expectedStatus = $this->status->shipmentCreated();
                break;
            case 'finish':
                $expectedStatus = $this->status->orderProcessed();
                break;
            case 'failed':
                $expectedStatus = $this->status->orderCancelled();
                break;
            case 'pending':
                $expectedStatus = $this->status->transactionPending();
                break;
            default:
                throw new CannotValidateOrder();
        }

        if($orderStatus->id === $expectedStatus->id) {
            return $next($request);
        }

        switch($orderStatus->id)
        {
            case $this->status->orderCreated()->id:
                $redirect = route('order.shipment', ['order', $order]);
                break;
            case $this->status->shipmentCreated()->id:
                $redirect = route('order.transaction', ['order', $order]);
                break;
            case $this->status->orderProcessed()->id:
                $redirect = route('order.success', ['order', $order]);
                break;
            case $this->status->paymentPending()->id:
                $redirect = route('order.pending', ['order', $order]);
                break;
            case $this->status->orderCancelled()->id:
                $redirect = route('order.failed', ['order', $order]);
                break;
            default:
                throw new CannotValidateStatus();
        }

        return redirect($redirect);
    }
}
