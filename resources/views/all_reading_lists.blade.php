<!DOCTYPE html>
<!-- this is also the homepage. -->
<html>
    <head>
        <title>Reading Recs</title>
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
                <a href="{{ route('login') }}">Log in</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
                @endif
                @endauth
        </div>
        @auth
        <!--         this is supposed to be a dropdown-->
<!--        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>{{ Auth::user()->name }}</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    Authentication 
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                         onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
                <x-slot name="content">
                    help...
                </x-slot>  
            </x-dropdown>
        </div>-->
@include('layouts.navigation')
        <nav>
            <ul>
                
            </ul>
        </nav>
        @endauth
        @endif
        <main>
        @if (count($lists) == 0)
        <p color='red'> There are no records in the database!</p>
        @else
        <table style="border: 1px solid black">
            <tr>
                <td> Name </td>
                <td> By: </td>
                <td> Description </td>
                <td> </td>
            </tr>
            @foreach ($lists as $list)
            <tr>
                <td> {{ $list->listname }} </td>
                <td> {{ $list->name }} </td>
                <td> {{ $list->description }} </td>
                <td><input type="button" value="See list contents" onclick="seeList('{{$list->listname}}')"></td>
                @auth
                <td><input type="button" value="Delete list" onclick="deleteList({{ $list->id }})"></td>
                @endauth
                @endforeach
        </table>
        @endif
        <p> <input type="button" value="See Books" onclick="seeBooks({})"> </p>
        @auth<p> <input type="button" value="New List (in development)" onclick="addBook({})"> </p>@endauth
<!--        <p> <input type="button" value="Search books" onclick="filterBooks({})"> </p>-->
        </main>
        <script> ///sample code for later
            function seeBooks() {
            window.location.href = "/books";
            }
            function addBook() {
            window.location.href = "/add_reading_list";
            }
            function deleteList(listID) {
            window.location.href = "/delete_reading_list/" + listID;
            }
            function seeBooks() {
            window.location.href = "/books";
            }
            function seeList(listname) {
            //var name = str_replace(' ', '_', $listname);
            window.location.href = "/reading_lists/" + listname;
            }
//            function filterBooks() {
//                window.location.href = "filter";
//            }
        </script>
    </body>
</html>