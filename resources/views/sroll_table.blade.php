<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car List UI</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for the design */
        .container {
            width: 550px;
            height: 100px;
            margin: 0 auto;
            padding: 20px;
            background-color:none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table-container {
            height: 350px;
            overflow: hidden;
            position: relative;
        }

        .table {
            width: 100%;
            margin-bottom: 0;
        }

        .table img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        /* Animation for infinite scrolling */
        @keyframes scroll {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(-100%);
            }
        }

        .scrollable-content {
            animation: scroll 25s linear infinite; /* Adjust speed here */
        }

        .scrollable-content:hover {
            animation-play-state: paused; /* Pause on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Cars List🚗</h2>
        <div class="table-container">
            <div class="scrollable-content">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Car Image</th>
                            <th>Car Name</th>
                            <th>Car Model</th>
                            <th>Daily Rent</th>
                            <th>Availability</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cars as $car)
                        <tr>
                            <td>
                                <img src="{{ asset($car->image) }}" alt="Car Image">
                            </td>
                            <td>{{ $car->name }}</td>
                            <td>{{ $car->model }}</td> 
                            <td>${{ $car->daily_rent_price }}</td>
                            @if($car->availability === 0)
                                <td><span class="badge bg-danger">SoldOut</span></td>
                            @else
                                <td><span class="badge bg-success">Avilable</span></td>
                            @endif
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>