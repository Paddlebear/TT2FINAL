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
        <p>Filter books...</p>
        <form method="POST" action="{{ action([App\Http\Controllers\BookController::class, 'filter']) }}">
            @csrf
            <p><label for="booktitle">{{ __('messages.Title or portion of it') }}: </label>
            <input type="text" name="booktitle" id="title"></p>
            <p><label for="author">{{ __('messages.Author or portion of it') }}: </label>
            <input type="text" name="author" id="author"></p>
            <p><label for="year_from">{{ __('messages.Year from') }}: </label>
            <input type="number" name="year_from" id="year_from"></p>
            <p><label for="year_until">{{ __('messages.Year until') }}: </label>
            <input type="number" name="year_until" id="year_until"></p>
            <p><label for="genre_select">{{ __('messages.Genre') }}: </label>
            <select id="genre_select" name="genre_id"></select></p>
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
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                var genres = <?= json_encode($genres) ?>;
                var genre_s = document.getElementById("genre_select");
                var lookup = {};
                var idents = {};
                //console.log(countries);
                //var countryname;
                for (let i in genres) { // for every item in the data - every piece of statistic info
                    let genre = genres[i].genrename; // read country from data
                    let ident = genres[i].id;
                    //console.log(country);
                    if (genre && !(genre in lookup)) { // if the continet hasn't been previously processed (is not present in lookup)
                        lookup[genre] = {}; // add a new continent to the lookup
                        idents[ident] = {};
                    }
                }
                //console.log(lookup); // uncomment this line if you want to see the result in the console
                var genrelist = Object.keys(lookup);
                var genreidlist = Object.keys(idents);
                console.log(genrelist); // uncomment this line if you want to see the result in the console
                console.log(genreidlist); // uncomment this line if you want to see the result in the console
                for (let i in genrelist) { // for every continent
                let opt = document.createElement('option'); // create a new OPTION element
                opt.innerHTML = genrelist[i]; // fill the text with the continent name
                opt.value = genreidlist[i]; // fill the value with the continent name
                genre_s.appendChild(opt); // add newly created OPTION to the continent SELECT element
            }
            });
        </script>
    </body>
</html>

