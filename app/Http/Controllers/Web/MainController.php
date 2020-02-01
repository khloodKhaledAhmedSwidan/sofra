<?php

namespace App\Http\Controllers\Web;

use App\Models\Client;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    //
    public function index(Request $request)
    {
        $restaurants = Restaurant::where(function ($q) use ($request) {
            if ($request->name) {
                $q->where('name', $request->name);
            } elseif ($request->region) {
                $q->where('region_id', $request->region);
            }
        })->latest()->paginate(5);

        return view('web.mainPage.index', compact('restaurants'));
    }

    public function products($id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant->is_active == 1) {

            $products = $restaurant->products()->get();

            return view('web.mainPage.products', compact('products', 'restaurant'));
        } else {
            return redirect()->route('main.page')->with('alert', 'restaurant is closed');
        }


    }

    public function product($id)
    {
        $product = Product::find($id);
        $comments = $product->restaurant->comments()->where('restaurant_id', $product->restaurant_id)->get();
        $resProducts = $product->restaurant->products()->where('restaurant_id', $product->restaurant->id)->get();

        return view('web.mainPage.product', compact('product', 'comments', 'resProducts'));
    }

    public function state(Request $request)
    {
        dd($request->all());
    }

    public function comment(Request $request, $id)
    {

        $product = Product::find($id);
        $restaurant_id = $product->restaurant_id;

        $client = auth()->user()->name;
        $request->validate(
            [
                'item' => 'required',
                'comment' => 'required'
            ]
        );
        if (Client::where('client_id', auth()->user()->id)) {
            session()->flash('fail','you commented before');
            return back();
        } else {
            $comment = Comment::create([
                'restaurant_id' => $restaurant_id,
                'client_id' => auth()->user()->id,
                'comment' => $request->comment,
                'name' => $client,
                'rate' => $request->item,


            ]);
            return redirect()->back();
        }

    }


    public function contactUsPage()
    {
        return view('web.mainPage.contact_us');
    }

    public function contactUs(Request $request)
    {
        $client = auth()->user()->id;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:11|numeric',
            'message' => 'required|min:11|max:255',
            'type' => 'required',
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'client_id' => $client,
            'type' => $request->type
        ]);


        return redirect()->back()->with('alert', 'send message successfully');
    }

}
