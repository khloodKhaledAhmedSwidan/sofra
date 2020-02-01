<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Session;

class OrderController extends Controller
{
    //


    public function myOrderPage()
    {
        $client = auth()->user()->id;
        $orders = Order::where(function ($q) use ($client) {
            if ($q->where('client_id', $client)) {
                $q->where('state', 'accepted');
            }
        })->get();
        if (count($orders) >= 1) {
            return view('web.clientOrder&Offer.my_order', compact('orders'));
        } else {
            // notification later
            \session()->flash('fail', 'this page is empty');
            return redirect()->back();
        }

    }


    public function delivered($id)
    {
        $order = Order::find($id)->update(['state' => 'delivered']);
//        return redirect('sofra/orders');
        return redirect()->route('previous.orders');
    }

    public function rejected($id)
    {
        $order = Order::find($id)->update(['state' => 'rejected']);
        return redirect()->route('previous.orders');
    }

    public function prevOrders()
    {
        $client = auth()->user();
        $orders = $client->orders()->where(function ($q) {
            $q->where('state', 'delivered');
            $q->orWhere('state', 'rejected');
        })->get();
        if (count($orders) >= 1) {
            return view('web.clientOrder&Offer.previous-orders', compact('orders'));
        } else {
            \session()->flash('fail', 'this page is empty');
            return redirect()->back();
        }


    }

    public function addOrders(Request $request)
    {


        $client = auth()->user()->id;
        $restaurant = Restaurant::find($request->restaurant_id);
        if ($restaurant->availability == 0) {
            return back()->with('message', 'restaurant is closed');
        }
        $amount = $request->amount;
        $total = $amount * $request->price;
        $order = $request->user()->orders()->create([
            'restaurant_id' => $restaurant->id,
            'special_order' => $request->note,
            'state' => 'pending',
            'cost' => $request->price,
            'client_id' => $client,
            'commission' => settings()->commission,
            'total' => $total,

        ]);


        $net = $total - ($total * settings()->commission);


        $order->products()->attach($request->product_id,
            [
                'amount' => $request->amount,
                'price' => $request->price,
                'notes' => (isset($request->note) ? $request->note : ''),
            ]);

        if ($total >= $restaurant->minimum) {


            $order->update([
                'net' => $net,
            ]);
            $data = ['order' => $order->fresh()->load('products')];
            $cart = session()->get('cart');
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
            return redirect('sofra/cart');
        } else {

            $order->delete();
            return back()->with('message', 'total of orders you want to buy must increase thanminimun of restaurany  ');
        }


    }

    public function sendOrders()
    {

        $client = auth()->user()->id;

        $restaurant = session('restaurant');
        $allOrdersPrice = 0;


        $restaurant = Restaurant::find($restaurant);

        if ($restaurant->availability == 0) {

            session()->flash('fail', 'resrauarnt is closed');

            return redirect('sofra/cart');
        }


        foreach (session()->get('cart') as $order) {

            $amount = $order['amount'];
            $total = $amount * $order['price'];
            $order = auth()->user()->orders()->create([
                'restaurant_id' => $restaurant->id,
                'special_order' => $order['note'],
                'state' => 'pending',
                'cost' => $order['price'],
                'commission' => settings()->commission,
                'total' => $total,

            ]);

            $net = $total - ($total * settings()->commission);


            $order->products()->attach($order['product_id'],
                [
                    'amount' => $order['amount'],
                    'price' => $order['price'],
                    'notes' => (isset($order['note']) ? $order['note'] : ''),
                ]);

            if ($total >= $restaurant->minimum) {


                $order->update([
                    'net' => $net,
                ]);
                //      $data = ['order' => $order->fresh()->load('products')];
                $allOrdersPrice = $net;

            } else {

                $order->delete();
                return back()->session()->flash('fail', 'total of orders you want to buy must increase thanminimun of restaurany');
            }

        }
        session()->forget('cart');
        session()->forget('restaurant');
        session()->flash('success', 'order sends successfully . total' . $allOrdersPrice);
        return redirect('sofra/cart');


    }
}
