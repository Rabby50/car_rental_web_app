<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;


class CarsController extends Controller
{
    //
    public function index(){
        $cars = Car::all();
        $users = User::all();
        return view('index', compact('cars','users'));
    }
    public function UserDashboard(){
        return view('dashboard');
    }

    public function about(){
        return view('about');
    }

    public function contact(){
        return view('contact');
    }
    public function allcars(){
        // $brands = Car::select('brand')->distinct()->get()->pluck('brand');
        // $models = Car::select('model')->distinct()->get()->pluck('model');
        // dd($brands, $models);  

        return view('cars');
        
    }
    public function filter(Request $request)
{
    // Get unique brands and models
        $brands = Car::pluck('brand')->unique();
        $models = Car::pluck('model')->unique();

        // Get filter inputs
        $brand = $request->input('brand');
        // $model = $request->input('model');

        // Query to filter cars
        $query = Car::query();

        if (!empty($brand)) {
            $query->where('brand', $brand);
        }

        // if (!empty($model)) {
        //     $query->where('model', $model);
        // }

        $cars = $query->get();

    return view('cars', compact('cars', 'brands'));
    }


    public function welcome(){
        return view('welcome');
    }

    public function sroll_table(){
        return view('sroll_table');
    }


}
