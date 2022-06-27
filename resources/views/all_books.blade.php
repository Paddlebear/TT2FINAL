<!DOCTYPE html>
<html>
    <head>
        <title>All books - Reading Recs</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
         @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                @else
                <a href="{{ route('login') }}">Log in</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
                @endif
                @endauth
        </div>
        @endif
        @include('layouts.navigation')
        @if (count($books) == 0)
        <p color='red'> There are no records in the database!</p>
        @else
        <table style="border: 1px solid black">
            <tr>
                <!--<td> ID </td> -->
                <td> Book Title </td>
                <td> Author </td>
                <td> Publication Year </td>
                <td> Genre </td>
                <td> </td>
            </tr>
            @foreach ($books as $book)
            <tr>
                <td> {{ $book->booktitle }} </td>
                <td> {{ $book->author }} </td>
                <td> {{ $book->publicationyear }} </td>
                <td> {{ $book->genrename }} </td>
                @auth<td>
                    <form method="POST"
                          action='{{action([App\Http\Controllers\ReadingListController::class, 'edit'], [$book -> id, Auth::id()]) }}'>
                        @csrf @method('GET')
                        <input type="submit" value="Add to List"></form> </td>@endauth
                @endforeach
        </table>
        @endif
        @auth<p> <input type="button" value="New Book" onclick="addBook({})"> </p>@endauth
<!--        <p> <input type="button" value="Search books" onclick="filterBooks({})"> </p>-->
        <script> ///sample code for later
            function addBook() {
                window.location.href = "/add_book";
            }
            function filterBooks() {
                window.location.href = "filter";
            }
        </script>
    </body>
</html>