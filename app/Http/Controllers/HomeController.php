<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('welcome');
    }

    public function checkout(): View
    {
        return view('checkout');
    }

    public function bookingDetails(): View
    {
        return view('booking-details');
    }

    public function generate(Request $request): Response
    {
        $request->validate([
            'business_type' => ['required', 'string', 'max:100'],
        ]);

        return response('Generated successfully');
    }
}
