<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantOrderController extends Controller
{
    //
    public function newOrder()
    {
        $restaurant = auth()->user();
        $orders = $restaurant->orders()->where('state', 'pending')->get();
        if (count($orders) >= 1) {
            return view('web.restaurantOrder.newOrder', compact('orders'));
        } else {
            return redirect()->back();
        }
    }

    public function accepted($id)
    {
        $order = Order::findOrFail($id)->update(['state' => 'accepted']);
//        return redirect('sofra/orders');
        return redirect()->route('current.orders');
    }

    public function rejected($id)
    {
        $order = Order::findOrFail($id)->update(['state' => 'rejected']);
        return redirect('sofra/previous-orders');
    }

    public function pervOrders()
    {
        $restaurant = auth()->user();

        $orders = $restaurant->orders()->where(function ($q) {
            $q->where('state', 'delivered');
            $q->orWhere('state', 'rejected');
        })->get();
        if (count($orders) >= 1) {
            return view('web.restaurantOrder.prev_orders', compact('orders'));
        } else {
            return redirect()->back();
        }


    }

    public function currentOrders()
    {
        $restaurant = auth()->user();

        $orders = $restaurant->orders()->where(function ($q) {
            $q->where('state', 'accepted');

        })->get();
        if (count($orders) >= 1) {
            return view('web.restaurantOrder.current-order', compact('orders'));
        } else {
            return redirect()->back();
        }

    }
}
