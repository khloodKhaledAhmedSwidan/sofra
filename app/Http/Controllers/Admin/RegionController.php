<?php

namespace App\Http\Controllers\Admin;


use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $regions = Region::paginate(10);
        return view('admin.regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cities = City::pluck('name', 'id')->all();
        if ($cities) {
            return view('admin.regions.create', compact('cities'));
        } else {
            return redirect()->route('regions.create');
        }
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
            'city_id' => 'required',
        ]);

        Region::create($request->all());

        session()->flash('success', 'Region created successfully!');
        return redirect()->route('regions.index');
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
        //
        $region = Region::findOrFail($id);
        $city = City::pluck('name', 'id')->all();
        return view('admin.regions.edit', compact('city', 'region'));
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
        $region = Region::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'city_id' => 'required',
        ]);
        $region->update($request->all());

        session()->flash('success', 'Region updated successfully!');
        return redirect()->route('regions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $region = Region::find($id);
        if (!$region) {
            return responseJson(0, 'No data');
        }
        if (count($region->clients) > 0 || count($region->restaurants) > 0) {
            return responseJson(0, 'you cannot delete this region,this region has clients');
        } else {
            $region->delete();
            return responseJson(1, 'Record deleted successfully!', $id);
        }
    }
}
