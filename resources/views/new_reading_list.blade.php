<!DOCTYPE html>
<html>
    <head>
        <title>New reading list - Reading Recs</title>
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
        We will add a new list to the system (feature is still in development), user id: {{$user->id}}:
        <form method="POST"
              action="{{action([App\Http\Controllers\ReadingListController::class, 'store']) }}">
            @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <input type="hidden" name="visible" value=1>
            <label for="listname">Reading List Name: </label>
            <input type="text" name="listname" id="listname">
            <label for="description">Description: </label>
            <input type="text" name="description" id="book_authors">
            <input type="submit" value="add">
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
    </body>
</html>