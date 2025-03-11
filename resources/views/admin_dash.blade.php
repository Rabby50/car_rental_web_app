<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            {{ __('Welcome To Admin Dashboard') }}
        </h2>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .main-content {
            padding: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <h3 class="text-center py-4">Admin Panel</h3>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#manage-cars">Manage Cars</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#manage-rentals">Manage Rentals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#manage-customers">Manage Customers</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 main-content">
                <!-- Dashboard Overview -->
                <section id="dashboard">
                    <h2>Dashboard Overview</h2>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Cars</h5>
                                    <p class="card-text">{{ $totalCars }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Available Cars</h5>
                                    <p class="card-text">{{ $availableCars }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Rentals</h5>
                                    <p class="card-text">{{ $totalRentals }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Earnings</h5>
                                    <p class="card-text">${{ number_format($totalEarnings, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Manage Cars -->
<section id="manage-cars" class="mt-5">
    <h2>Manage Cars</h2>
    <button onclick="car_create()" class="btn btn-primary mb-3">Add New Car</button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Car Img</th>
                <th>Car Name</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Type</th>
                <th>Year</th>
                <th>Daily Rent</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
            <tr>
                <td>
                    <img src="{{ asset($car->image) }}" alt="Car Image" width="35" height="35">
                </td>
                <td>{{ $car->name }}</td>
                <td>{{ $car->brand }}</td>
                <td>{{ $car->model }}</td>                
                <td>{{ $car->car_type}}</td>
                <td>{{ $car->year }}</td>
                <td>${{ $car->daily_rent_price }}</td>
                <td>{{ $car->availability ? 'Available' : 'Not Available' }}</td>
                <td>
                    <a href="{{ route('car.edit', $car->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('car.destroy', $car->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>


                <!-- Manage Rentals -->
                <section id="manage-rentals" class="mt-5">
                    <h2>Manage Rentals</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Rental ID</th>
                                <th>Customer Name</th>
                                <th>Car Details</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Cost</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rentals as $rental)
                            <tr>
                                <td>{{ $rental->car_id }}</td>
                                <td>{{ $rental->user->name }}</td>
                                <td>{{ $rental->car->model }}</td>
                                <td>{{ $rental->start_date }}</td>
                                <td>{{ $rental->end_date}}</td>
                                <td>{{ $rental->total_cost}}</td>
                                <td>Ongoing</td>
                            

                                
                                <td>
                                    <form action="{{ route('rental.destroy', $rental->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this rental?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Cancel Rental</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>

                <!-- Manage Customers -->
                <section id="manage-customers" class="mt-5">
                    <h2>Manage Customers</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Rental History</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                                <td>5 Rentals</td>
                                <td>
                                    <button class="btn btn-sm btn-warning">Edit</button>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this rental?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        function car_create() {
            window.location.href = "{{ route('car.create') }}";
        }
    </script>
</body>
</html>
    </x-slot>
</x-app-layout>

