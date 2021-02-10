<?php

namespace App\Http\Middleware;

use App\Exceptions\CannotValidateOrder;
use App\Exceptions\CannotValidateStatus;
use App\Models\Order;
use App\Repository\StatusRepositoryInterface as Status;
use Closure;
use Illuminate\Http\Request;

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
        $order = $request->route('order');

        if (!$orderStatus = $order->recent_status) {
            throw new CannotValidateStatus();
        }

        switch ($current) {
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

        if ($orderStatus->id === $expectedStatus->id) {
            return $next($request);
        }

        switch ($orderStatus->id) {
            case $this->status->orderCreated()->id:
                $redirect = route('customer.order.shipment', ['order' => $order]);
                break;
            case $this->status->shipmentCreated()->id:
                $redirect = route('customer.order.transaction', ['order' => $order]);
                break;
            case $this->status->orderProcessed()->id:
                $redirect = route('customer.order.status.success', ['order' => $order]);
                break;
            case $this->status->transactionPending()->id:
                $redirect = route('customer.order.status.pending', ['order' => $order]);
                break;
            case $this->status->orderCancelled()->id:
                $redirect = route('customer.order.status.failed', ['order' => $order]);
                break;
            default:
                throw new CannotValidateStatus();
        }

        return redirect($redirect);
    }
}
