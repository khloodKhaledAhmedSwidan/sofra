<?php

namespace App\Http\Controllers\Api;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    //
public function restaurantInformation(Request $request){
    $restaurant = Restaurant::where('id',$request->restaurant_id)->get();



if($restaurant){

return responseJson(1,'success',$restaurant);
}else{
return responseJson(0,'failed');
}
}
}
