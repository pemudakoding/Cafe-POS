<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        input:focus {
            outline: 0;

        }

        input {
            border: 0;
            border-bottom: 2px solid var(--blue-color) !important;
        }

        form {
            height: 100vh;
        }
    </style>
</head>

<body>

    <div class="self-container d-flex">

        <div class="col-3">
            <form action="{{ route('auth') }}" method="POST" class="d-flex flex-column px-4 justify-content-center">
                @csrf
                <div class="col-12 mb-4">
                    <div class="text-danger">
                        {{ Session('alert') }}
                    </div>
                </div>
                <input type="text" name="username" id="username" class=" mb-4 p-2 bg-transparent" placeholder="Username"
                    autocomplete="off">
                <input type="password" name="password" id="password" class=" mb-4 p-2 mt-2 bg-transparent "
                    placeholder="Password" autocomplete="off">
                <button type=" submit" class="btn btn-primary rounded-lg shadow-blue mt-2">Masuk</button>
            </form>
        </div>
        <div class="col-9 bg-primary d-flex justify-content-center align-content-center">
            <img src="{{ asset('img/cashier.svg') }}" alt="">
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"> </script>
</body>

</html>