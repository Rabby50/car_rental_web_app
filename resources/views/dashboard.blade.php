<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome To Car Rental App !") }}
                </div>
            </div>
        </div>

        {{-- -------------------------------------------------------------------------------------- --}}
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Rental History</title>
    <style>
        /* Default CSS for table and container */
    
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color:white;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            background-color: #f4f4f4;
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        
        img {
            border-radius: 5px;
            width: 30%;
            height: 50%;
            object-fit: cover;
        }

        .text-center {
            text-align: center;
        }

        .text-muted {
            color: #6c757d;
        }
    </style>
</head>
    <div class="container">
        <h2>My Rental History</h2>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Car Image</th>
                        <th>Car Model</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Total Cost ($)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($User_rentals as $rental)
                        <tr>
                            <td>
                                <img src="{{ asset($rental->car->image) }}" alt="Car Image">
                            </td>
                            <td>{{ $rental->car->model }}</td>
                            <td>{{ $rental->start_date }}</td>
                            <td>{{ $rental->end_date }}</td>
                            <td>${{ number_format($rental->total_cost, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No rental history found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ route('car.index') }}" class="btn btn-primary text-white">
                🏠 Go Home
            </a>
            
        </div>
    </div>

        {{-- --------------------------------------------------------------------------------------- --}}
        
    </div>
    
    
</x-app-layout>

