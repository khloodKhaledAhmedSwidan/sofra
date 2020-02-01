<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cities = City::paginate(6);
        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.cities.create');
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
        $request->validate([
            'name' => 'required',
        ]);
        City::create($request->all());
        session()->flash('success', 'city stored successful');
        return redirect()->route('cities.index');


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('admin.cities.edit', compact('city'));
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
        $city = City::find($id);
        $request->validate([
            'name' => 'required|unique:cities,name,' . $id,
        ]);
        $city->update($request->all());
        $notification = array(
            'message' => 'City updated successfully!',
            'alert-type' => 'info');
        return redirect()->route('cities.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
//    {
//        //
//
//        $city = City::findOrFail($id);
//if(count($city->regions)>0){
//    $notification = array(
//        'message' => 'you can not remove this!',
//        'alert-type' => 'info');
//    return redirect()->route('cities.index')->with($notification);
//} else{
//    return responseJson(200,'success' , $city);
//    return  redirect()->route('cities.index')->with($notification);
//}
//
//    }


    public function destroy($id)
    {
        $city = City::find($id);
        if (!$city) {
            return responseJson(0, 'No data');
        }
        if (count($city->regions)) {
            return responseJson(0, 'do not remove this category');
        } else {
            $city->delete();
            return responseJson(1, 'Record deleted successfully!', $id);
        }
    }


}
