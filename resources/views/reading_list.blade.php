<!DOCTYPE html>
<html>
    <head>
        <title>{{$list[0]->listname}} - Reading Recs</title>
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
            <p style="font-weight:bold; font-size:24px;">{{$list[0]->listname}} - {{$list[0]->name}}:</p>
            @if (count($books) == 0)
            <p color='red'>{{ __('messages.emptylist') }}</p>
            @else
            <table>
                <tr>
                    <!--<td> ID </td> -->
                    <th> {{ __('messages.Book Title') }}</th>
                    <th> {{ __('messages.Author') }}</th>
                    <th> {{ __('messages.Publication Year') }}</th>
                    <th> {{ __('messages.Genre') }}</th>
            </tr>
                @foreach ($books as $book)
                <tr>
                    <td> {{ $book->booktitle }} </td>
                    <td> {{ $book->author }} </td>
                    <td> {{ $book->publicationyear }} </td>
                    <td> {{ $book->genrename }} </td>
                    @endforeach
                    @endif        
            </table>
            <p></p>
            @if (count($tags) == 0)
            <p color='red'>{{ __('messages.emptytags') }}</p>
            @else
            <p>{{ __('messages.Tags') }}:</p>
            <table>
                @foreach ($tags as $tag)
                <tr>
                    <td> {{ $tag->tagname }} </td>
                    @endforeach
                    @endif
            </table>
        </main>
    </body>
</html>