<!DOCTYPE html>
<html>
    <head>
        <title>{{ __('messages.profile', ['name'=>$user->name]) }} - Reading Recs</title>
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
        <p style="font-weight:bold; font-size:24px;">{{ __('messages.profile', ['name'=>$user->name]) }}</p>
            @if (count($lists) == 0)
            <p color='red'>{{ __('messages.norecords') }}</p>
            @else
            <table>
                <tr>
                    <th> {{ __('messages.Name') }}</th>
                    <th> {{ __('messages.By') }}: </th>
                    <th> {{ __('messages.Description') }}</th>
                    @auth
                    @if (Auth::id() == $user->id)
                    <th> </th>
                    <th> </th>
                    <th> </th>
                    <th> </th>
                    @endif
                    @endauth
                </tr>
                @foreach ($lists as $list)
                <tr>
                    <td> {{ $list->listname }} </td>
                    <td> {{ $list->name }} </td>
                    <td> {{ $list->description }} </td>
                    <td><input type="button" value="{{ __('messages.See list contents') }}" onclick="seeList('{{$list->listname}}')"></td>
                    @auth
                    @if (Auth::id() == $list -> user_id)
                    <td><input type="button" value="{{ __('messages.Update') }}" onclick="editList({{ $list->id }})"></td>
                    <td><input type="button" value="{{ __('messages.Add tags') }}" onclick="addTags({{ $list->id }})"></td>
                    <td><input type="button" value="{{ __('messages.Delete list') }}" onclick="deleteList({{ $list->id }})"></td>
                    @endif
                    @endauth
                    @endforeach
            </table>
            @endif
            @auth
            @if (Auth::id() == $user->id)
            <p> <input type="button" value="{{ __('messages.New list') }}" onclick="addList({{Auth::id()}})"> </p>
            @endif
            @endauth
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
            function editList(id) {
            window.location.href = "/edit_list/" + id;
            }
            function addTags(id) {
            window.location.href = "/add_tags_to_list/" + id;
            }
//            function filterBooks() {
//                window.location.href = "filter";
//            }
        </script>
    </body>
</html>