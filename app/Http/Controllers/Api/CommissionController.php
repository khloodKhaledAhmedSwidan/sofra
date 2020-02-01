<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommissionController extends Controller
{
    //
    public function commission()
    {
        $restaurant = auth()->user();
     $orders =   $restaurant->orders()->pluck('total')->toArray();
//     dd($orders);
     if (!$orders){
         return responseJson(0,'no orders');
     }
     $total = 0 ;

        $commission = settings()->commission;
foreach ($orders as $value){
    $total += $value;


}

$netApp = $total * $commission;
$netRestaurant = $total - $netApp;
return responseJson(1,'total of orders :'.$total. 'commission of this app. '.$commission.'net'.$netRestaurant);

    }
}
