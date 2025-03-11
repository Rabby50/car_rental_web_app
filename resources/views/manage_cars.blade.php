<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #121212; /* Mat black background */
            color: #ffffff; /* White text */
        }
        .form-container {
            background-color: #1e1e1e; /* Dark gray container */
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }
        .form-control, .form-select {
            background-color: #2d2d2d; /* Dark gray input fields */
            color: #ffffff; /* White text */
            border: 1px solid #444; /* Dark border */
        }
        .form-control:focus, .form-select:focus {
            background-color: #2d2d2d;
            color: #ffffff;
            border-color: #666;
            box-shadow: none;
        }
        .btn-primary {
            background-color: #0d6efd; /* Bootstrap primary blue */
            border: none;
        }
        .btn-primary:hover {
            background-color: #0b5ed7; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 form-container">
                <h2 class="mb-4">Add New Car</h2>
                <form action="{{ route('car.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Car Image -->
                    <div class="mb-3">
                        <label for="carImage" class="form-label">Car Image</label>
                        <input type="file" class="form-control" id="carImage" name="carImage" accept="image/*" required>
                    </div>

                    <!-- Car Name -->
                    <div class="mb-3">
                        <label for="carName" class="form-label">Car Name</label>
                        <input type="text" class="form-control" id="carName" name="carName" required>
                    </div>

                    <!-- Brand -->
                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>

                    <!-- Model -->
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>

                    <!-- Year of Manufacture -->
                    <div class="mb-3">
                        <label for="year" class="form-label">Year of Manufacture</label>
                        <input type="number" class="form-control" id="year" name="year"min="1900" max="{{ date('Y') }}" required>
                    </div>

                    <!-- Car Type -->
                    <div class="mb-3">
                        <label for="carType" class="form-label">Car Type</label>
                        <select class="form-select" id="carType" name="carType" required>
                            <option value="SUV">SUV</option>
                            <option value="Sedan">Sedan</option>
                            <option value="Hatchback">Hatchback</option>
                            <option value="Coupe">Coupe</option>
                            <option value="Convertible">Convertible</option>
                            <option value="Truck">Truck</option>
                        </select>
                    </div>

                    <!-- Daily Rent Price -->
                    <div class="mb-3">
                        <label for="dailyRentPrice" class="form-label">Daily Rent Price</label>
                        <input type="number" class="form-control" id="dailyRentPrice" name="dailyRentPrice" step="0.01" required>
                    </div>

                    <!-- Availability Status -->
                    <div class="mb-3">
                        <label for="availability" class="form-label">Availability Status</label>
                        <select class="form-select" id="availability" name="availability" required>
                            <option value="Available">Available</option>
                            <option value="Not Available">Not Available</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Add Car</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>