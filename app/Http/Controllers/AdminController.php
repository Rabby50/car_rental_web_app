<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rental;
use App\Models\Car;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin(){
        $cars = Car::all();
        $users = User::all();
        $rentals = Rental::all();
        $totalCars = Car::count();
        $availableCars = Car::where('availability', true)->count();
        $totalRentals = Rental::count();
        $totalEarnings = Rental::sum('total_cost');

        return view('admin_dash', compact('cars','users','rentals','totalCars','availableCars','totalRentals','totalEarnings'));
    }
    
    // ----------------Manage Cars section start --------------------------------------
    public function create(Request $request)
    {
        return view('manage_cars');
    }


    public function store(Request $request)
    {
    //Debugging: check form data if needed
    // dd($request->all());

    $validatedData = $request->validate([
        'carImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'carName' => 'required|string',
        'brand' => 'required|string',
        'model' => 'required|string',
        'year' => 'required|integer|min:1900|max:2023',
        'carType' => 'required|in:SUV,Sedan,Hatchback,Coupe,Convertible,Truck',
        'dailyRentPrice' => 'required|numeric',
        'availability' => 'required|in:Available,Not Available',
    ]);

    $imagePath = null;
    if ($request->hasFile('carImage')) {
        $image = $request->file('carImage');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('car_images'), $imageName);
        $imagePath = 'car_images/' . $imageName; 
    }

    $availabilityValue = ($request->availability === 'Available') ? 1 : 0;

    try {
        Car::create([
            'name' => $request->carName,
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'car_type' => $request->carType,
            'daily_rent_price' => $request->dailyRentPrice,
            'availability' => $availabilityValue,
            'image' => $imagePath,
        ]);
    }catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
        return redirect()->route('car.admin')->with('success', 'Car added successfully.');

    }   
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('edit_car', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $validatedData = $request->validate([
            'carName' => 'required|string',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'carType' => 'required|in:SUV,Sedan,Hatchback,Coupe,Convertible,Truck',
            'dailyRentPrice' => 'required|numeric',
            'availability' => 'required|boolean',
            'carImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('carImage')) {
            if ($car->image && file_exists(public_path($car->image))) {
                unlink(public_path($car->image));
            }

            $image = $request->file('carImage');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('car_images'), $imageName);
            $validatedData['image'] = 'car_images/' . $imageName;
        }

        $car->update($validatedData);

        return redirect()->route('car.admin')->with('success', 'Car updated successfully.');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        
        if ($car->image && file_exists(public_path($car->image))) {
            unlink(public_path($car->image));
        }

        $car->delete();

        return redirect()->route('car.admin')->with('success', 'Car deleted successfully.');
    }


// ----------This is for Rental maintaning  section------------------
public function destroyRental($id)
{
    $rental = Rental::findOrFail($id);
    if (!$rental) {
        return redirect()->route('car.admin')->with('error', 'Rental record not found or unauthorized.');
    }

    $rental->delete();
    return redirect()->route('car.admin')->with('success', 'Rental canceled successfully.');
}

// -----------------------This is for cuatomer details maintaining section ------------------------------
public function Userdestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('car.admin')->with('success', 'Car deleted successfully.');
    }


}

