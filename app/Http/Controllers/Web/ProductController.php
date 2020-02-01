<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(8);
        return view('web.restaurantProduct.index',compact('products'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('web.restaurantProduct.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $restaurant = auth('site_restaurant')->user()->id;

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price_on_offer' => 'required|numeric',
            'price' => 'required|numeric',
            'photo' => 'required|image',

        ]);
        $product = Product::create([
            'name' => $request->name,
            'description' =>$request->description,
            'price_on_offer'=>$request->price_on_offer,
            'price' =>$request->price,

            'restaurant_id' =>$restaurant,
        ]);




        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/restaurantProduct/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $product->photo = 'uploads/restaurantProduct/' . $name;
            $product->save();
        }
        $product->save();


        return redirect()->route('restaurant-products.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::findOrFail($id);
        return view('web.restaurantProduct.show',compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('web.restaurantProduct.edit',compact('product'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //


        $product = Product::find($id);
        $restaurant = auth('site_restaurant')->user()->id;

        $this->validate($request, [


            'price' => 'numeric',
            'price_on_offer' => 'numeric',


        ]);
        $product->update($request->except('photo'));
        if ($request->hasFile('photo')) {
            if(file_exists($product->photo))
                unlink($product->photo);
            $path = public_path();
            $destinationPath = $path . '/uploads/restaurantProduct/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $product->photo = 'uploads/restaurantProduct/' . $name;
            $product->save();
        }

        return  redirect()->route('restaurant-products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('restaurant-products.index');
    }


}
