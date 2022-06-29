<!DOCTYPE html>
<!-- this is also the homepage. -->
<html>
    <head>
        <title>{{ __('messages.Search results') }} - Reading Recs</title>
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
            @if (count($lists) == 0)
            <p color='red'>{{ __('messages.norecords') }}</p>
            @else
            <table>
                <tr>
                    <!--<td> ID </td> -->
                    <th> {{ __('messages.Name') }}</th>
                    <th> {{ __('messages.By') }}:</th>
                    <th> {{ __('messages.Description') }}</th>
                    <th> </th>
                </tr>
                @foreach ($lists as $list)
                <tr>
                    <td> {{ $list->listname }} </td>
                    <td> {{ $list->name }} </td>
                    <td> {{ $list->description }} </td>
                    <td><input type="button" value="{{ __('messages.See list contents') }}" onclick="seeList('{{$list->listname}}')"></td>
                    @endforeach
            </table>
            @endif
    <!--        <p> <input type="button" value="Search books" onclick="filterBooks({})"> </p>-->
        </main>
        <script> ///sample code for later
            function seeBooks() {
            window.location.href = "/books";
            }
            function addList(id) {
            window.location.href = "/add_reading_list/" + id;
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
            function seeProfile(name) {
            window.location.href = "/profile/" + name;
            }

//            function filterBooks() {
//                window.location.href = "filter";
//            }
        </script>
    </body>
</html>