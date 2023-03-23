<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{URL::asset('css/app.css')}}">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>

        <x-navbar :logged="session('logged')" :user="session('user')" />

          <div class="contenedorMainHome">
            <div class="imagenMain"></div>
            <div class="textoMain">
                <h2 class="tituloMain">.Music.</h2>
                <p class="p-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat, laborum iure quo ut numquam dolorem porro, accusantium sit quaerat vel totam nihil? Facere commodi temporibus qui aliquam suscipit similique! Voluptas.
                Quaerat corrupti at cumque doloribus assumenda aliquid unde odio maiores atque obcaecati eos vitae repudiandae corporis animi minus nemo cupiditate porro soluta pariatur, ut laudantium. Vel ab placeat quos distinctio?
                Eveniet culpa hic nemo recusandae neque Voluptatum rem delectus animi, earum iure praesentium unde sunt iste iusto consequatur, nobis tempore veniam quae cum minima aperiam, consequuntur molestias nemo? Voluptatibus consequuntur fuga ad?</p>
                <button class="btn boton">Login</button>
            </div>
        </div>

       {{--    @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">

                       <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif

                </div>
            @endif --}}
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>
