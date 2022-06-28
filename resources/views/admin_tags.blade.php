<!DOCTYPE html>
<html>
    <head>
        <title>{{ __('messages.All Tags') }}, admin - Reading Recs</title>
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
        @if (count($tags) == 0)
        <p color='red'> {{ __('messages.norecords') }}</p>
        @else
        <table style="border: 1px solid black">
            <tr>
                <!--<td> ID </td> -->
                <td> {{ __('ID') }}</td>
                <td> {{ __('messages.Name') }}</td>
                <td> </td>
            </tr>
            @foreach ($tags as $tag)
            <tr>
                <td> {{ $tag->id }} </td>
                <td> {{ $tag->tagname }} </td>
                @auth
                @can('is-admin')
                <td><form method="POST" action="{{action([App\Http\Controllers\AdminController::class, 'deletetag'], $tag->id) }}">
                        @csrf @method('DELETE')<input type="submit" value="{{ __('messages.Delete') }}"></form></td>@endcan @endauth
                @endforeach
        </table>
        @endif
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
    </body>
</html>