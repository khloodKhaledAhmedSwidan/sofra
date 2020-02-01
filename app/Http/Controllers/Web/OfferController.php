<?php

namespace App\Http\Controllers\Web;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::paginate(3);
        return view('web.restaurantOffer.index',compact('offers'));
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
        return view('web.restaurantOffer.create');
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
            'from' => 'required|date',
            'to' => 'required|date',
            'cost' => 'required|numeric',
            'photo' => 'required|image',

        ]);
        $offer = Offer::create([
            'name' => $request->name,
            'description' =>$request->description,
            'from'=>$request->from,
            'to' =>$request->to,
            'cost'=>$request->cost,
            'restaurant_id' =>$restaurant,
        ]);




        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/restaurantOffer/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $offer->photo = 'uploads/restaurantOffer/' . $name;
            $offer->save();
        }
        $offer->save();


        return redirect()->route('restaurant-offers.index');


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
        $offer = Offer::findOrFail($id);
        return view('web.restaurantOffer.show',compact('offer'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        return view('web.restaurantOffer.edit',compact('offer'));
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


        $offer = Offer::find($id);
        $restaurant = auth('site_restaurant')->user()->id;

        $this->validate($request, [

            'from' => 'date',
            'to' => 'date',
            'cost' => 'numeric',


        ]);
        $offer->update($request->except('photo'));
        if ($request->hasFile('photo')) {
            if(file_exists($offer->photo))
                unlink($offer->photo);
            $path = public_path();
            $destinationPath = $path . '/uploads/restaurantOffer/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $offer->photo = 'uploads/restaurantOffer/' . $name;
            $offer->save();
        }

        return  redirect()->route('restaurant-offers.index');
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
        $offer = Offer::findOrFail($id);
        $offer->delete();
        return redirect()->route('restaurant-offers.index');
    }
}
