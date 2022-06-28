<!DOCTYPE html>
<html>
    <head>
        <title>User list - Reading Recs</title>
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
            <!--            <a href="{{ url('/home') }}">Homepage</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
            
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                 this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>-->
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
            @if (count($users) == 0)
            <p color='red'>{{ __('messages.norecords') }}</p>
            @else
            <table style="border: 1px solid black">
                <tr>
                    <td> ID </td>
                    <td>{{ __('messages.Username') }}</td>
                    <td>{{ __('messages.E-mail') }}</td>
                    <td> </td>
                </tr>
                @foreach ($users as $user)
                <tr>
                    <td> {{ $user->id }} </td>
                    <td> {{ $user->name }} </td>
                    <td> {{ $user->email }} </td>
                    <td><input type="button" value="{{ __('messages.Delete user') }}" onclick="deleteUser('{{$user->id}}')"></td>
                    @endforeach
            </table>
            @endif
        </main>
<!--        <p> <input type="button" value="New Book" onclick="addCountry({})"> </p>
        <p> <input type="button" value="Search books" onclick="filterBooks({})"> </p>-->
        <script> ///sample code for later
            function deleteUser(id)
            {
            window.location.href = "/admin/users/" + id;
            }
        </script>
    </body>
</html>