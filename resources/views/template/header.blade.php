<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Monitoring</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #navbar {
            background-color: rgba(0, 0, 0, 0.7);
            transition: transform 0.3s ease-in-out;
        }

        #navbar.hidden {
            transform: translateY(-100%);
        }

        .nav-link {
            color: #fff !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #00bcd4 !important;
        }

        .navbar-brand h6,
        .navbar-brand p {
            color: #fff;
            font-size: 14px;
        }

        .navbar-brand img {
            width: 50px;
            height: auto;
        }

        #about {
            background-image: url('{{ asset('storage/assets/prambanan.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        #services img {
            width: 200px;
            height: auto;
        }
    </style>


</head>

<body>
