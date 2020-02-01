<?php

namespace App\Http\Controllers\admin;

use App\Models\Client;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function index()
    {
        $clientsCount = Client::count();
        $restaurantsCount = Restaurant::count();
        $ordersCount = Order::count();
        $contactsCount = Contact::count();
        return view('admin.index', compact('clientsCount', 'restaurantsCount', 'ordersCount', 'contactsCount'));
    }
}
