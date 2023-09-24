<?php

namespace App\Http\Controllers;

use App\Http\Requests\BakingTypeRequest;
use App\Http\Requests\CloseOrderRequest;
use App\Http\Requests\MakeBakeRequest;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\BakingTypeResource;
use App\Http\Resources\CloseOrderResource;
use App\Http\Resources\MakeBakeResource;
use App\Http\Resources\CreateOrderResource;
use App\Http\Resources\OrderListResource;
use App\Models\Bake;
use App\Models\BakingType;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function createOrder(CreateOrderRequest $request)
    {
        $order = new Order();
        $bake = Bake::query()->where('id', $request->getBakeId())->first();
        $bookedOrdersCount = Order::query()
            ->where('bake_id', $request->getBakeId())
            ->where('closed', false)
            ->pluck('count')->sum();
        if (!($bake->count - $bookedOrdersCount) >= $request->getCount()) {
            throw new \Exception('not enough baked goods of this type');
        }
        $order->count = $request->getCount();
        $order->bake_id = $request->getBakeId();
        $order->user_id = $bake->user_id;
        $order->closed = false;
        $order->save();
        return CreateOrderResource::make($order);
    }

    public function orderList(): OrderListResource
    {
        $orders = Order::query()
            ->where('user_id', Auth::getUser()->id)
            ->where('closed', false)
            ->paginate(10);
        return OrderListResource::make($orders);
    }

    public function closeOrder(CloseOrderRequest $request)
    {
        $order = Order::query()
            ->where('id', $request->getOrderId())
            ->first();
        if ($order->closed) {
            throw new \Exception('This order is already closed');
        }
        $order->closed = true;
        $order->save();
        $bake = Bake::query()
            ->where('id', $order->bake_id)
            ->first();
        $bake->count = $bake->count - $order->count;
        $bake->save();
        return CloseOrderResource::make($order);
    }
}
