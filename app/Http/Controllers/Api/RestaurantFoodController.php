<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantFoodController extends Controller
{
    //
    public function add_product(Request $request)
    {
        $restaurant = auth()->user()->id;
        $validator = validator()->make($request->all(), [

            'photo' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'price_on_offer' => 'required',


        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        } else {
            $product = Product::create([
                'photo' => $request->photo,
                'restaurant_id' => $restaurant,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'price_on_offer' => $request->price_on_offer,

            ]);

            $product->save();
            return responseJson(1, 'success', $product);
        }
    }

    public function update_product(Request $request,$id){
        $product = Product::findOrFail($id);
        $restaurant = auth()->user()->id;

if($restaurant === $product->restaurant_id){
           $product->update($request->all());
      return responseJson(1, 'success', $product);
}else{
    return responseJson(0,'failed');
}



    }
    public function product($id){
        $product = Product::findOrFail($id);
        $restaurant = auth()->user()->id;

if($restaurant === $product->restaurant_id ){
return responseJson(1,'success',$product);
}else{
return responseJson(0,'failed');
}

        return responseJson(1,'success',$product);
    }




    public function products(){
        $restaurant = auth()->user()->id;
        $products = Product::where('restaurant_id',$restaurant)->get();
        if(count($products) > 0){
            return responseJson(1,'success',$products);
        }else{
            return responseJson(0,'failed');
        }
    }
}
