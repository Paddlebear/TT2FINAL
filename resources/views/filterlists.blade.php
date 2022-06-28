<!DOCTYPE html>
<html>
    <head>
        <title>{{ __('messages.Add book to list') }} - Reading Recs</title>
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
            <p>Filter lists...</p>
            <form method="POST" action="{{ action([App\Http\Controllers\ReadingListController::class, 'filter']) }}">
                @csrf
                <p><label for="listname">{{ __('messages.Name or portion of it') }}: </label>
                    <input type="text" name="listname" id="listname"></p>
                <p><label for="name">{{ __('messages.Creator or portion of it') }}: </label>
                    <input type="text" name="name" id="name"></p>
                <p><label for="tag_select">{{ __('messages.Tag') }}: </label>
                    <select id="tag_select" name="tag_id"></select></p>
                <p><input type="submit" value="{{ __('messages.Search') }}"></p>
                @if (count($errors) > 0)
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </form>
        </main>
        <script>
window.addEventListener('DOMContentLoaded', (event) => {
    var tags = <?= json_encode($tags) ?>;
    var tag_s = document.getElementById("tag_select");
    var lookup = {};
    var idents = {};
    for (let i in tags) { // for every item in the data - every piece of statistic info
        let tag = tags[i].tagname; // read country from data
        let ident = tags[i].id;
        if (tag && !(tag in lookup)) { // if the continet hasn't been previously processed (is not present in lookup)
            lookup[tag] = {}; // add a new continent to the lookup
            idents[ident] = {};
        }
    }
    //console.log(lookup); // uncomment this line if you want to see the result in the console
    var taglist = Object.keys(lookup);
    var tagidlist = Object.keys(idents);
    console.log(taglist); // uncomment this line if you want to see the result in the console
    console.log(tagidlist); // uncomment this line if you want to see the result in the console
    for (let i in taglist) { // for every continent
        let opt = document.createElement('option'); // create a new OPTION element
        opt.innerHTML = taglist[i]; // fill the text with the continent name
        opt.value = tagidlist[i]; // fill the value with the continent name
        tag_s.appendChild(opt); // add newly created OPTION to the continent SELECT element
    }
});
        </script>
    </body>
</html>

