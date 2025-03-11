<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($car) ? 'Edit Car' : 'Add Car' }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212; /* Matte black background */
            color: #ffffff; /* White text */
        }
        .form-container {
            background-color: #1e1e1e; /* Dark gray container */
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }
        .form-control, .form-select {
            background-color: #2d2d2d; /* Dark input fields */
            color: #ffffff; 
            border: 1px solid #444;
        }
        .form-control:focus, .form-select:focus {
            background-color: #2d2d2d;
            color: #ffffff;
            border-color: #666;
            box-shadow: none;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 form-container">
                <h2 class="mb-4">{{ isset($car) ? 'Edit Car' : 'Add New Car' }}</h2>
                
                <form action="{{ isset($car) ? route('car.update', $car->id) : route('car.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($car))
                        @method('PUT')
                    @endif

                    <!-- Car Image -->
                    <div class="mb-3">
                        <label for="carImage" class="form-label">Car Image</label>
                        <input type="file" class="form-control" id="carImage" name="carImage" accept="image/*">
                        @if(isset($car) && $car->image)
                            <img src="{{ asset($car->image) }}" alt="Car Image" class="mt-2" width="150">
                        @endif
                    </div>

                    <!-- Car Name -->
                    <div class="mb-3">
                        <label for="carName" class="form-label">Car Name</label>
                        <input type="text" class="form-control" id="carName" name="carName" value="{{ old('carName', $car->name ?? '') }}" required>
                    </div>

                    <!-- Brand -->
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $car->brand ?? '') }}" required>
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $car->model ?? '') }}" required>
                    </div>

                    <!-- Year -->
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" id="year" name="year" min="1900" max="{{ date('Y') }}" value="{{ old('year', $car->year ?? '') }}" required>
                    </div>

                    <!-- Car Type -->
                    <div class="mb-3">
                        <label for="carType" class="form-label">Car Type</label>
                        <select class="form-select" id="carType" name="carType" required>
                            @foreach(['SUV', 'Sedan', 'Hatchback', 'Coupe', 'Convertible', 'Truck'] as $type)
                                <option value="{{ $type }}" {{ isset($car) && $car->car_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Daily Rent -->
                    <div class="mb-3">
                        <label for="dailyRentPrice" class="form-label">Daily Rent Price</label>
                        <input type="number" class="form-control" id="dailyRentPrice" name="dailyRentPrice" step="0.01" value="{{ old('dailyRentPrice', $car->daily_rent_price ?? '') }}" required>
                    </div>

                    <!-- Availability -->
                    <div class="mb-3">
                        <label for="availability" class="form-label">Availability</label>
                        <select class="form-select" id="availability" name="availability" required>
                            <option value="1" {{ isset($car) && $car->availability ? 'selected' : '' }}>Available</option>
                            <option value="0" {{ isset($car) && !$car->availability ? 'selected' : '' }}>Not Available</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">{{ isset($car) ? 'Update Car' : 'Add Car' }}</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
