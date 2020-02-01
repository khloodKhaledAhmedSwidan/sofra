<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientOrderController extends Controller
{
    //
    public function newOrder(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'restaurant_id' => 'required|exists:restaurants,id',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.amount' => 'required',
        ]);
        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }
        $restaurant = Restaurant::find($request->restaurant_id);
//         dd($restaurant);
        $client = auth()->user()->id;


        if ($restaurant->availability == 0) {
            return responseJson(0, 'restaurant closed');
        }
        $order = $request->user()->orders()->create([
            'restaurant_id' => $restaurant->id,
            'special_order' => $request->special_order,
            'state' => 'pending',
            'client_id' => $client,

        ]);
        $cost = 0;
        $delivery_cost = $restaurant->delivery_charge;
        foreach ($request->products as $i) {
            $product = Product::find($i['product_id']);

            $readyProduct = [
                $i['product_id'] => [
                    'amount' => $i['amount'],
                    'price' => $product->price,
                    'notes' => (isset($i['special_order']) ? $i['special_order'] : ''),
                ]
            ];
            $order->products()->attach($readyProduct);
            $cost += ($product->price * $i['amount']);
        }
        if ($cost >= $restaurant->minimum) {
            $total = $cost + $delivery_cost;
            $commission = settings()->commission * $cost;
            $net = $total - settings()->commission;
            $updateOrder = $order->update([
                'cost' => $cost,
                'commission' => $commission,
                'total' => $total,
                'net' => $net,

            ]);

            $restaurant->notifications()->create([
                'title' => 'you have new order',
                'content' => 'you have new order by client' . $request->user()->name,
                'order_id' => $order->id,
            ]);
            $tokens = $restaurant->tokens()->where('token', '!=', '')->pluck('token')->toArray();
            if (count($tokens)) {
                $title = $restaurant->notifications()->title;
                $body = $restaurant->notifications()->content;
                $data = [
                    'action' => 'new-order',
                    'order_id' => $order->id,
                ];

                $send = notifyByFirebase($title, $body, $tokens, $data);

            }


            $data = ['order' => $order->fresh()->load('products')];
            return responseJson(1, 'success', $data);
        } else {
            $order->products()->delete();
            $order->delete();
            return responseJson(0, 'restaurant minimum' . $restaurant->minimum);
        }

    }
}
