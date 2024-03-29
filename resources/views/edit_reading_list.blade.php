<!DOCTYPE html>
<html>
    <head>
        <title>{{ __('messages.Update reading list') }}</title>
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
            {{ __('messages.updatelist', ['name' => $list->listname])}}:
            <form method="POST" action="/list/update">
                @csrf
                <input type="hidden" name="id" value="{{ $list->id }}">
                <input type="hidden" name="user_id" value="{{ $list->user_id }}">
                <input type="radio" id="yes" name="visible" value=1>
                <label for="yes">{{ __('messages.Visible') }}</label><br>
                <input type="radio" id="no" name="visible" value=0>
                <label for="no">{{ __('messages.Hidden') }}</label><br>
                <label for="listname">{{ __('messages.Name') }}: </label>
                <input type="text" name="listname" id="listname" value="{{ $list->listname }}">
                <label for="description">{{ __('messages.Description') }}: </label>
                <input type="text" name="description" id="description" value="{{ $list->description }}">
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
        </main>
    </body>
</html>