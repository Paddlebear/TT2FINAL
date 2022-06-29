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
            @if (count($lists) == 0)
            <p color='red'>{{ __('messages.nolist') }}</p>
            @else
            {{ __('messages.addtolist', ['title' => $book->booktitle]) }}:
            <form method="POST" action="/add_to_list">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <!--            <label for="booktitle">Title: </label>
                            <input type="text" name="booktitle" id="booktitle" value="{{ $book->booktitle }}">
                            <label for="author">Author: </label>
                            <input type="text" name="author" id="author" value="{{ $book->author }}">
                            <label for="publicationyear">Publication year: </label>
                            <input type="number" name="publicationyear" id="publicationyear" value="{{ $book->publicationyear }}">-->
                <label for="list_select">{{ __('messages.Reading Lists') }}: </label>
                <select id="list_select" name="reading_list_id"></select>
                <input type="submit" value="{{ __('messages.Update') }}">
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
            @endif
            <script>
    window.addEventListener('DOMContentLoaded', (event) => {
        var lists = <?= json_encode($lists) ?>;
        var list_s = document.getElementById("list_select");
        var lookup = {};
        var idents = {};
        for (let i in lists) { // for every item in the data - every piece of statistic info
            let list = lists[i].listname; // read country from data
            let ident = lists[i].id;
            if (list && !(list in lookup)) { // if the continet hasn't been previously processed (is not present in lookup)
                lookup[list] = {}; // add a new continent to the lookup
                idents[ident] = {};
            }
        }
        //console.log(lookup); // uncomment this line if you want to see the result in the console
        var listlist = Object.keys(lookup);
        var listidlist = Object.keys(idents);
        console.log(listlist); // uncomment this line if you want to see the result in the console
        console.log(listidlist); // uncomment this line if you want to see the result in the console
        for (let i in listlist) { // for every continent
            let opt = document.createElement('option'); // create a new OPTION element
            opt.innerHTML = listlist[i]; // fill the text with the continent name
            opt.value = listidlist[i]; // fill the value with the continent name
            list_s.appendChild(opt); // add newly created OPTION to the continent SELECT element
        }
    });
            </script>
        </main>
    </body>
</html>