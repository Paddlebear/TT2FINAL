<!DOCTYPE html>
<html>
    <head>
        <title>Delete a reading list //do the swirly brackets for the name thing, same in routing</title>
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
        Are you sure you want to delete this list with id {{ $list->id }}?
        <td>
                    <form method="POST"

                          action="{{action([App\Http\Controllers\ReadingListController::class, 'destroy'], $list->id) }}">
                        @csrf @method('DELETE')<input type="submit"
                                                      value="delete"></form> </td>
                </td>
    </body>
</html>