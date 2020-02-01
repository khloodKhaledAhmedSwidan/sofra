<?php

namespace App\Http\Controllers\Web;


use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientOfferController extends Controller
{
    //
    public function offers(){
        $offers = Offer::paginate(3);
return view('web.clientOrder&Offer.offers',compact('offers'));
    }
}
