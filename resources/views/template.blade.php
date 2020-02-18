<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Users - Admin Panel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!--  CDN Bootstrap  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html,
        body {
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            margin: 0;
            box-sizing: border-box;
        }

        section {
            position: relative;
            height: 100vh;
            width: 100%;
        }

        .left,
        .right {
            width: 50%;
        }

        .left {
            background: url({{ asset('images/left.jpg')
        }
        }

        )no-repeat;
        background-size: cover;
        background-position: center;
        }

        img {
            width: 100%;
        }

        input {
            border: none;
            border-bottom: 1px solid #999;
            width: 50%;
        }

        span {
            font-weight: 600;
        }

        footer {
            position: absolute;
            bottom: 2%;
            font-size: 12px;
        }

    </style>
</head>

<body>

    <main>
        <section class="d-flex flex-nowrap">
            <div class="left"></div>
            <div class="right d-flex justify-content-center align-items-center">
                <div class="container d-flex flex-column justify-content-center align-items-center">
                    <h1 class="title text-center">Admin Panel</h1>
                    <p class="text-center">Welcome, please click on <span>Enter</span></p>
                    <input type="text" placeholder="Your mail" class="pt-3">
                    <input type="text" placeholder="Your password" class="pt-3">
                    <a href="adminpanel" type="button" class="btn btn-outline-dark mt-4">Enter</a>
                </div>
                <footer>2019 - Tony Dam</footer>
            </div>
        </section>
    </main>


</body>

</html>
