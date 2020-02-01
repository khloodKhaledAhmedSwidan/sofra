<?php

namespace App\Http\Controllers\Web;


use App\Models\Category;
use App\Models\Client;
use App\Models\Region;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    //


    public function registerFormClient()
    {
        $region = Region::pluck('name', 'id')->all();
        return view('web.authPage.register', compact('region'));
    }

    public function registerClient(Request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'region_id' => 'required',
            'photo' => 'required',
            'password' => 'required|confirmed',
        ]);
        $client = new   Client;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->region_id = $request->region_id;

        $client->password = bcrypt($request->password);


        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/auth/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $client->photo = 'uploads/auth/' . $name;
            $client->save();
        }
        $client->save();


        return redirect()->route('loginPage.client');


    }


    public function loginPage()
    {
        return view('web.authPage.login');
    }
    public function loginPageRestaurant()
    {
        return view('web.authPage.restaurant-login');
    }


    public function restaurantlogin(Request $request){


        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

      if (auth('site_restaurant')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('restaurant-products.index');
        } else {
            return redirect()->back()->with('error', 'password or email is not found!');

        }
    }
    public function login(Request $request)
    {


        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth('site_client')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->route('main.page');
        }

        else {
            return redirect()->back()->with('error', 'password or email is not found!');

        }
    }


    public function registerFormRestaurant()
    {
        $region = Region::pluck('name', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();
        return view('web.authPage.register-restaurant', compact('region', 'categories'));
    }


    public function registerRestaurant(Request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'region_id' => 'required',
            'photo' => 'required',
            'password' => 'required|confirmed',
            'minimum' => 'required',
            'delivery_charge' => 'required',
            'processing_time' => 'required',
            'whatsapp' => 'required',
            'category_id' => 'required|array',
        ]);
        $restaurant = Restaurant::create($request->all());
        $restaurant->password = bcrypt($request->password);

        $restaurant->categories()->attach($request->category_id);

        if ($request->hasFile('photo')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/auth/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $restaurant->photo = 'uploads/auth/' . $name;
            $restaurant->save();
        }
        $restaurant->save();


        return redirect()->route('');


    }
    public  function restaurantProfilePage(){
        $restaurant = auth()->user();
        $region = Region::pluck('name', 'id')->all();
        $categories = Category::pluck('name', 'id')->all();
        return view('web.authPage.restaurant-profile',compact('restaurant','region','categories'));
    }
    public function restaurantProfile(Request $request){
        $restaurant = auth()->user();
        $this->validate($request, [
            'email' => 'email',
            'password' => 'required|confirmed',
            'category_id' => 'array',
        ]);
        $restaurant->update($request->except('photo'));
        $restaurant->categories()->sync($request->category_id);
        if($request->password){
            $restaurant->password = bcrypt($request->password);
            $restaurant->save();
        }
        if ($request->hasFile('photo')) {
            if(file_exists($restaurant->photo))
                unlink($restaurant->photo);
            $path = public_path();
            $destinationPath = $path . '/uploads/auth/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $restaurant->photo = 'uploads/auth/' . $name;
            $restaurant->save();
        }

        return  redirect()->route('restaurant-products.index')->with('success','updated successfully');
    }



    public  function clientProfilePage(){

        $client = auth('site_client')->user();
        $region = Region::pluck('name', 'id')->all();

        return view('web.authPage.client-profile',compact('client','region'));
    }
    public  function clientProfile(Request $request){
        $client = auth()->user();
        $this->validate($request, [
            'email' => 'email',
            'password' => 'required|confirmed',

        ]);
        $client->update($request->except('photo'));

        if($request->password){
            $client->password = bcrypt($request->password);
            $client->save();
        }
        if ($request->hasFile('photo')) {
            if(file_exists($client->photo))
                unlink($client->photo);
            $path = public_path();
            $destinationPath = $path . '/uploads/auth/'; // upload path
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension(); // getting image extension
            $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
            $photo->move($destinationPath, $name); // uploading file to given path
            $client->photo = 'uploads/auth/' . $name;
            $client->save();
        }

        return  redirect()->route('main.page')->with('success','updated successfully');
    }

    public function logout(Request $request)
    {
        Auth::guard('site_client')->logout();
        session()->forget('restaurant');
        session()->forget('cart');

        $request->session()->invalidate();
        return redirect()->route('loginPage.client');


    }


}
