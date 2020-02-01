<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use App\Mail\ResetPassword;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Mail;

class ClientController extends Controller
{
    //
    public function register(Request $request)
    {


        $validator = validator()->make($request->all(), [
            'name' => 'required|min:6|max:255',
            'email' => 'required|unique:restaurants',
            'photo' => 'required',
            'region_id' => 'required|exists:regions,id',
            'password' => 'required|min:6|max:255|confirmed',
            'phone' => 'required',

        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }


        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());

        $client->api_token = str_random(60);

        $client->save();
        return responseJson(1, 'success', [
            'api_token' => $client->api_token,
            'client' => $client,
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


        $client = Client::where('email', $request->email)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                return responseJson(1, 'success', [
                    'api_token' => $client->api_token,
                    'client' => $client,
                ]);
            } else {
                return responseJson(0, 'failed');
            }
        } else {
            return responseJson(0, 'failed');
        }

    }


    public function forgot_password(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $client = Client::where('phone', $request->phone)->first();

        if ($client) {
            $code = str_random(5);

            $update = $client->update(['pin_code' => $code]);

            if ($update) {

                Mail::to($client->email)
                    ->bcc("khloodkhaledswidan420@gmail.com")
                    ->send(new ResetPassword($code));

                return responseJson(1, 'success', $client);
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
        $client = Client::where('pin_code', $request->pin_code)->first();

        if ($client) {


            $client->password = bcrypt($request->password);
            $client->api_token = str_random(60);
            $client->pin_code = null;
            $client->save();
            return responseJson(1, 'success', [
                'api_token' => $client->api_token,
                'client' => $client,
            ]);


        } else {
            return responseJson(0, 'failed');
        }


    }

    public function profile(Request $request)
    {
        $validator = validator()->make($request->all(), [

            'password' => 'required|confirmed',
            'email' => 'unique:clients,email',
            'name' => 'min:6|max:255',
            'region_id' => 'exists:regions,id',

        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $client = auth()->user();

        $client->update($request->all());
        return responseJson(1, 'success', $client);
    }


    public function addComment(Request $request)
    {
        $client = auth()->user()->id;
        $validator = validator()->make($request->all(), [

            'comment' => 'required',
            'name' => 'required|min:6|max:255',
            'restaurant_id' => 'exists:restaurants,id',
            'rate' => 'required|in:1,2,3,4,5',
        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        } else {
            $comment = Comment::create([
                'comment' => $request->comment,
                'client_id' => $client,
                'name' => $request->name,
                'restaurant_id' => $request->restaurant_id,
                'rate' => $request->rate,
            ]);

            $comment->save();
            return responseJson(1, 'success', $comment);


        }


    }

    public function contactUs(Request $request)
    {
        $client = auth()->user()->id;
        $validator = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'message' => 'required',
            'type' => 'required|in:complaint,suggest,Inquire',
        ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        } else {
            $data = Contact::create([
                'name' => $request->name,
                'client_id' => $client,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
                'type' => $request->type,
            ]);
            $data->save();
            return responseJson(1, 'success', $data);

        }
    }


    public function registerToken(Request $request)
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
    public function removeToken(Request $request){
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
