<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\City;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Region;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    //
    public function cities(){
        $cities = City::paginate(6);
        return responseJson(1,'success',$cities);
    }

    public function regions(Request $request){
        $regions = Region::where(function($query) use($request){
            if($request->has('city_id')){
                $query->where('city_id',$request->city_id);
            }
        })->get();
        return responseJson(1,'success',$regions);
    }
    public function categories(){
        $categories = Category::paginate(6);
        return responseJson(1,'success',$categories);
    }
    public function restaurants(Request $request){
        $restaurants = Restaurant::where(function ($query) use($request){
            if($request->name){
                $query->where('name',$request->name);
            }
            if($request->city_name){
                $query->whereHas('region' , function ($q) use($request){
                    $q->where('name', 'LIKE', '%' . $request->city_name . '%');
                });
            }
        })->paginate(5);
        return responseJson(1,'success',$restaurants);
    }
     public  function  products(Request $request){
        $products = Product::where('restaurant_id',$request->restaurant_id)->paginate(6);

return responseJson(1,'success',$products);
     }
     public  function comments(){
        $comments = Comment::paginate(7);
        return responseJson(1,'success',$comments);
     }
     public function about_us(){
        $about_us = Setting::all();
        return responseJson(1,'success',$about_us);
     }
     public function about_restaurant(Request $request){
        $about_restaurant = Restaurant::where('id',$request->restaurant_id)->get();

        if($about_restaurant){
            foreach ($about_restaurant as $availability){

                if ($availability->availability == 1){
                    return responseJson(1,'success',$about_restaurant);
                }else{
                    return responseJson(0,'closed',$about_restaurant);
                }

            }

      }
     }
}
