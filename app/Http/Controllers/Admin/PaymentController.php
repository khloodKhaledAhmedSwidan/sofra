<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $setting = Setting::find(1);
//        $commision = $setting->commission;
//$restaurants = Restaurant::all();
//foreach ($restaurants as $restaurant){
//$netApp = 0;
//  $total = 0 ;
//  foreach ($restaurant->orders as $order){
//    $total += $order->total;
//  }
//  $netApp = $commision*$total;
//
//}
//        $restaurants = Restaurant::where(function ($q) use ($request) {
//            if ($request->search) {
//                $q->where('name', 'LIKE', '%' . $request->search . '%');
//
//            }
//        })->paginate(6);
        $payments = Payment::orwhereHas('restaurant', function ($q) use ($request) {
            $q->where('name', 'LIKE', '%' . $request->search . '%');
        })->paginate(6);
        return view('admin.payments.index', compact('payments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return responseJson(0, 'No data');
        }

        $payment->delete();
        return responseJson(1, 'Record deleted successfully!', $id);
    }


}
