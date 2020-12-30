<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container my-4">


        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
                @endif
                @endauth
            </div>
            @endif

            <div class="content mb-4">

                <div class="title m-b-md">
                    webCheckout
                </div>

                <div class="container">
                    <div class="row my-3 ml-3 d-flex justify-content-center">
                        <form class="d-line" action="{{route('orders.store')}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">Description</label>
                                <h4><textarea name="texTarea" id="texTarea" cols="50" rows="5"
                                        placeholder="Descripción de la compra"
                                        required>Compra en Lobo de arte</textarea></h4>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">amount payable</label>
                                <input type="number" class="form-control" id="exampleFormControlInput1"
                                    placeholder="amount payable">
                            </div>

                            <button type="submit" class="btn btn-primary">make payment</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->



</body>

</html>