<!DOCTYPE html>
<html>
    <head>
        <title>{{ __('messages.All Books') }}, admin - Reading Recs</title>
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
            <a href="{{ route('login') }}">{{ __('messages.Log in') }}</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">{{ __('messages.Register') }}</a>
            @endif
            @endauth
        </div>
        @endif
        @include('layouts.navigation')
        <main>
            @if (count($books) == 0)
            <p color='red'> {{ __('messages.norecords') }}</p>
            @else
            <table>
                <tr>
                    <!--<td> ID </td> -->
                    <th> {{ __('messages.Book Title') }}</th>
                    <th> {{ __('messages.Author') }}</th>
                    <th> {{ __('messages.Publication Year') }}</th>
                    <th> {{ __('messages.Genre') }}</th>
                    <th> </th>
            </tr>
                @foreach ($books as $book)
                <tr>
                    <td> {{ $book->booktitle }} </td>
                    <td> {{ $book->author }} </td>
                    <td> {{ $book->publicationyear }} </td>
                    <td> {{ $book->genrename }} </td>
                    @auth
                    @can('is-admin')<td> <input type="button" value="{{ __('messages.Update') }}" onclick="editBook({{ $book->id }})"> </td>
                    <td><form method="POST" action="{{action([App\Http\Controllers\BookController::class, 'destroy'], $book->id) }}">
                            @csrf @method('DELETE')<input type="submit" value="{{ __('messages.Delete') }}"></form></td>@endcan @endauth
                    @endforeach
            </table>
            @endif
            @auth<p> <input type="button" value="{{ __('messages.New Book') }}" onclick="addBook({})"> </p>@endauth
    <!--        <p> <input type="button" value="Search books" onclick="filterBooks({})"> </p>-->
            <script> ///sample code for later
                function addBook() {
                window.location.href = "/add_book";
                }
                function editBook(id) {
                window.location.href = "/edit_book/" + id;
                }
                function filterBooks() {
                window.location.href = "filter";
                }
            </script>
        </main>
    </body>
</html>