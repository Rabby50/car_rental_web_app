<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class RentalsController extends Controller
{   
    public function rental_form($id)
    {   
        $car = Car::findOrFail($id);
        $users = User::all();
        return view('manage_rental', compact('car'));
    }
     public function store(Request $request)
        {
            
            $request->validate([
                'rentalId' => 'required|exists:cars,id',
                'startDate' => 'required|date',
                'endDate' => 'required|date|after:start_date',
            ]);

            $car = Car::findOrFail($request->rentalId);
            
            $days = (strtotime($request->endDate) - strtotime($request->startDate)) / 86400;
            $totalCost = $days * $car->daily_rent_price;

        Rental::create([
            'user_id' => Auth::id(),
            'car_id' => $request->rentalId,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
            'total_cost' => $totalCost,
        ]);

        // Mark car as unavailable
        $car->update(['availability' => false]);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}


