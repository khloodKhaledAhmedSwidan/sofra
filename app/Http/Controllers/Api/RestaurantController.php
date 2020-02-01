<?php

namespace App\Http\Controllers\Api;

use App\Mail\ResetPassword;
use App\Models\Restaurant;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Mail;
class RestaurantController extends Controller
{
    //
    public function register(Request $request)
    {


        $validator = validator()->make($request->all(), [
            'name' => 'required|min:6|max:255',
            'password' => 'required|min:6|max:255|confirmed',
            'phone' => 'required',
            'email' => 'required|unique:restaurants',
            'region_id'=>'required|exists:regions,id',
            'minimum'=>'required',
            'delivery_charge'=>'required',
            'availability'=>'required|in:1,0',
            'processing_time'=>'required',
            'photo'=>'required',
            'whatsapp'=>'required',

        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }


        $request->merge(['password' => bcrypt($request->password)]);
        $restaurant = Restaurant::create($request->all());

     $restaurant->api_token = str_random(60);

        $restaurant->save();
        return responseJson(1, 'success', [
            'api_token' => $restaurant->api_token,
            'restaurant' => $restaurant,
        ]);

    }


    public function login(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'email' => 'required',
            'password' => 'required',

        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }


        $restaurant = Restaurant::where('email', $request->email)->first();
        if ($restaurant) {
            if (Hash::check($request->password, $restaurant->password)) {
                return responseJson(1, 'success', [
                    'api_token' => $restaurant->api_token,
                    'restaurant' => $restaurant,
                ]);
            } else {
                return responseJson(0, 'failed');
            }
        } else {
            return responseJson(0, 'failed');
        }


    }
    public function profile(Request $request){

        $validator = validator()->make($request->all(), [

            'password' => 'required|confirmed',
            'email' => 'unique:restaurants,email',
            'name' => 'min:6|max:255',
            'region_id'=>'exists:regions,id',
            'availability'=>'in:1,0',
        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $restaurant = auth()->user();

        $restaurant->update($request->all());
        return responseJson(1, 'success', $restaurant);
    }




    public function forgot_password(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $restaurant = Restaurant::where('phone', $request->phone)->first();

        if ($restaurant) {
            $code = str_random(5);

            $update = $restaurant->update(['pin_code' => $code]);

            if ($update) {

                Mail::to($restaurant->email)
                    ->bcc("khloodkhaledswidan420@gmail.com")
                    ->send(new ResetPassword($code));

                return responseJson(1, 'success', $restaurant);
            } else {
                return responseJson(0, 'failed , try again');
            }


        } else {
            return responseJson(0, 'failed');
        }

    }

    public function reset_password(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'pin_code' => 'required',
            'password' => 'required|confirmed'
        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $restaurant = Restaurant::where('pin_code', $request->pin_code)->first();

        if ($restaurant) {


            $restaurant->password = bcrypt($request->password);
            $restaurant->api_token = str_random(60);
            $restaurant->pin_code = null;
            $restaurant->save();
            return responseJson(1, 'success', [
                'api_token' => $restaurant->api_token,
                'restaurant' => $restaurant,
            ]);


        } else {
            return responseJson(0, 'failed');
        }


    }




    public function registerTokenRestaurant(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'token' => 'required',

        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        Token::where('token', $request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return responseJson(1, 'success');


    }
    public function removeTokenRestaurant(Request $request){
        $validator = validator()->make($request->all(), [
            'token' => 'required',

        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        Token::where('token', $request->token)->delete();
        return responseJson(1, 'remove successfully');
    }



}
