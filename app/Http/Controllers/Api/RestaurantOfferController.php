<?php

namespace App\Http\Controllers\Api;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantOfferController extends Controller
{
    //
    public function addOffer(Request $request){
        $restaurant = auth()->user()->id;
        $validator = validator()->make($request->all(), [

            'photo' => 'required',
            'name' => 'required',
            'description' => 'required',
            'from' => 'required',
            'to' => 'required',


        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        } else {
            $offer = Offer::create([
                'photo' => $request->photo,
                'restaurant_id' => $restaurant,
                'name' => $request->name,
                'description' => $request->description,
                'from' => $request->from,
                'to' => $request->to,

            ]);

            $offer->save();
            return responseJson(1, 'success', $offer);
        }
    }

    public function updateOffer(Request $request,$id){
        $restaurant = auth()->user()->id;
        $offer = Offer::findOrFail($id);
        if($restaurant === $offer->restaurant_id){
$offer->update($request->all());
return responseJson(1,'success',$offer);
        }else{
return responseJson(0,'failed');
        }
    }
    public function offers(){
        $restaurant = auth()->user()->id;
$offers = Offer::where('restaurant_id',$restaurant)->get();
if(count($offers) > 0){
    return responseJson(1,'success',$offers);
}else{
    return responseJson(0,'failed');
}
    }
}
