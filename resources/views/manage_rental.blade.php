<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Rental</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for matte black background and white inputs */
        body {
            background-color: #1a1a1a; /* Matte black background */
            color: #ffffff; /* White text */
            padding: 20px;
        }

        .card {
            background-color: #333333; /* Dark gray background for card */
            border: 1px solid #555555; /* Light gray border */
            color: #ffffff; /* White text */
        }

        .form-control {
            background-color: #444444; /* Dark gray background for inputs */
            color: #ffffff; /* White text */
            border: 1px solid #555555; /* Light gray border */
        }

        .form-control:focus {
            background-color: #555555; /* Slightly lighter gray on focus */
            color: #ffffff; /* White text */
            border-color: #ffffff; /* White border on focus */
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.5); /* White glow on focus */
        }

        .form-label {
            color: #ffffff; /* White text for labels */
        }

        .btn-primary {
            background-color: #007bff; /* Bootstrap primary blue */
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3;
        }

        .form-select {
            background-color: #444444; /* Dark gray background for dropdown */
            color: #ffffff; /* White text */
            border: 1px solid #555555; /* Light gray border */
        }

        .form-select:focus {
            background-color: #555555; /* Slightly lighter gray on focus */
            color: #ffffff; /* White text */
            border-color: #ffffff; /* White border on focus */
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.5); /* White glow on focus */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4">
            <h2 class="mb-4 text-center">Add New Rental</h2>
            <form action="{{ route('rental.store') }}" method="POST">
                @csrf
                <!-- Car Image -->
                <div class="mb-3 text-center">
                    @if(isset($car) && $car->image)
                        <img src="{{ asset($car->image) }}" alt="Car Image" class="img-fluid rounded" width="150">
                    @endif
                </div>

                <!-- Rental ID -->
                <div class="mb-3">
                    <label for="rentalId" class="form-label">Rental ID</label>
                    <input class="form-control" id="rentalId" name="rentalId" value="{{ $car->id }}" readonly>
                </div>

                <!-- Customer Name -->
                <div class="mb-3">
                    <label for="customerName" class="form-label">Customer Name</label>
                    <input type="text" class="form-control" id="customerName" name="customerName" value="{{ $car->name }}" readonly>
                </div>

                <!-- Car Details -->
                <div class="mb-3">
                    <label for="carDetails" class="form-label">Car Brand</label>
                    <input type="text" class="form-control" id="carDetails" name="car_brand" value="{{ $car->brand }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="carDetails" class="form-label">Car Model</label>
                    <input type="text" class="form-control" id="carDetails" name="carDetails" value="{{ $car->model }}" readonly>
                </div>

                <!-- Rental Start Date -->
                <div class="mb-3">
                    <label for="startDate" class="form-label">Rental Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="startDate" required>
                </div>

                <!-- Rental End Date -->
                <div class="mb-3">
                    <label for="endDate" class="form-label">Rental End Date</label>
                    <input type="date" class="form-control" id="end_date" name="endDate" required>
                </div>

                <!-- Daily Cost -->
                <div class="mb-3">
                    <label for="totalCost" class="form-label">Daily Cost</label>
                    <input type="number" class="form-control" id="daily_cost" name="daily_cost" step="0.01" value="{{ $car->daily_rent_price }}" readonly>
                </div>

                <!-- Total Cost -->
                <div class="mb-3">
                    <label for="totalCost" class="form-label">Total Cost</label>
                    <input type="number" class="form-control" id="total_cost" name="total_cost" step="0.01" readonly>
                </div>

                <!-- Submit Button -->
                @if ($car->availability == 1)
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Confirm Rental</button>
                    </div>
                @else
                    <div class="d-grid">
                        <p>Sorry Sir</p>
                    </div>
                @endif
                
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let startDateInput = document.getElementById("start_date");
            let endDateInput = document.getElementById("end_date");
            let totalCostInput = document.getElementById("total_cost");
    
            function calculateTotalCost() {
                let startDate = new Date(startDateInput.value);
                let endDate = new Date(endDateInput.value);
                let dailyRent = {{ $car->daily_rent_price }}; // Fetching dynamic rent price
    
                if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime()) && endDate > startDate) {
                    let days = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)); // Ensure full day count
                    let totalCost = days * dailyRent;
    
                    totalCostInput.value = totalCost.toFixed(2); // Format the total cost properly
                } else {
                    totalCostInput.value = ""; // Clear field if invalid
                }
            }
    
            startDateInput.addEventListener("change", calculateTotalCost);
            endDateInput.addEventListener("change", calculateTotalCost);
        });
    </script>
    
</body>
</html>