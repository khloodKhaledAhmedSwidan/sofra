<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $restaurants = Restaurant::where(function ($q) use ($request) {
            if ($request->search) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $request->search . '%')
                    ->orWhereHas('region', function ($q) use ($request) {
                        $q->where('name', 'LIKE', '%' . $request->search . '%');
                    });
            }
        })->paginate(6);
        return view('admin.restaurants.index', compact('restaurants'));
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
        //
        $restaurant = Restaurant::findOrFail($id);
        return view('admin.restaurants.show', compact('restaurant'));
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
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return responseJson(0, 'No data');
        }
        if (count($restaurant->payments) || count($restaurant->comments) || count($restaurant->orders) || count($restaurant->offers) || count($restaurant->products)) {
            return responseJson(0, 'do not remove this Restaurant');
        } else {
            $restaurant->delete();
            return responseJson(1, 'Record deleted successfully!', $id);
        }
    }


    public function isActive($id)
    {
        $restaurant = Restaurant::find($id);
        if ($restaurant->is_active == 0) {
            $restaurant->update([
                'is_active' => 1,
            ]);
            session()->flash('success', 'restaurant is  not active ');
            return redirect()->route('restaurants.index');
        } else {
            $restaurant->update([
                'is_active' => 0,
            ]);
            session()->flash('success', 'restaurant is active ');
            return redirect()->route('restaurants.index');
        }
    }
}
