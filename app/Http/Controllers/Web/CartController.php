<?php

namespace App\Http\Controllers\Web;

use App\Models\Comment;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function list()
    {
        $cart = session()->get('cart');
//return $cart;
        return view('web.mainPage.cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        if(!session()->exists('restaurant'))
        {
            session()->put('restaurant',$request->restaurant_id);

        }elseif (session('restaurant') != $request->restaurant_id)
        {
            session()->flash('fail','all order should be in the same place');
            return back();
        }
        // product_id price quantity note
        $cart = session()->get('cart');
        $cart[$request->product_id] = [
            'restaurant_id ' => $request->restaurant_id ,
            'product_id' => $request->product_id,
            'name' =>$request->name,
            'amount' => $request->amount,
            'price' => $request->price,
            'note' => $request->note,
        ];
        session()->put('cart', $cart);
        return redirect()->route('list.cart');
    }

    public function removeFromCart($id)
    {

        // product_id price quantity note
        $cart = session()->get('cart');

        unset($cart[$id]);
        session()->put('cart', $cart);
        count($cart)?'':session()->forget('restaurant');
        return redirect()->route('main.page');
    }

    public function removeAllCart(Request $request)
    {
        session()->forget('restaurant');
        session()->forget('cart');
        session()->flash('success', 'cart  deleted successfully');
        return redirect()->route('main.page');

    }


}
