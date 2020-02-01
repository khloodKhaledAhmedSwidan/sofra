<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $clients = Client::where(function ($q) use ($request) {
            if ($request->search) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $request->search . '%')
                    ->orWhereHas('region', function ($q) use ($request) {
                        $q->where('name', 'LIKE', '%' . $request->search . '%');
                    });
            }
        })->paginate(6);
        return view('admin.clients.index', compact('clients'));
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
//    public function destroy($id)
//    {
//        //
//        $client = Client::findOrFail($id);
//        $client->delete();
//        $notification = array(
//            'message' => 'Client deleted Successfully',
//            'alert-type' => 'error'
//        );
//        return redirect()->route('clients.index')->with($notification);
//    }


    public function destroy($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return responseJson(0, 'No data');
        }


        if(count($client->contacts) ||count($client->comments)||count($client->orders)){
            return responseJson(0, 'you can’t remove this client');
        }
      else {
            $client->delete();

            return responseJson(1, 'Record deleted successfully!', $id);

        }


    }


    public function isActive($id)
    {
        $client = Client::find($id);
        if ($client->is_active == 0) {
            $client->update([
                'is_active' => 1,
            ]);
            session()->flash('success', 'this client is not active ');
            return redirect()->route('clients.index');
        } else {
            $client->update([
                'is_active' => 0,
            ]);
            session()->flash('success', 'this client is active ');
            return redirect()->route('clients.index');
        }
    }
}
