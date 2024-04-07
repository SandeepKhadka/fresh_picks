<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome To Fresh Picks</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background-color: #f3f4f6; /* Change background color */
        }

        .text-container {
            text-align: center;
            padding: 20px;
            background-color: #fff; /* Change background color */
            border-radius: 8px; /* Add border radius */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add shadow */
        }

        .title {
            font-size: 24px; /* Increase font size */
            margin-bottom: 20px; /* Add margin */
            color: #333; /* Change text color */
        }

        .btn {
            background-color: #4caf50; /* Change button background color */
            color: white; /* Change button text color */
            text-decoration: none; /* Remove underline */
            padding: 10px 20px; /* Add padding */
            border-radius: 5px; /* Add border radius */
            transition: background-color 0.3s; /* Add transition */
        }

        .btn:hover {
            background-color: #45a049; /* Change button background color on hover */
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="text-container">
            <h1 class="title">Welcome To Fresh Picks</h1>
            <a href="/admin" class="btn">Go to Dashboard</a>
        </div>
    </div>
</body>
</html>
