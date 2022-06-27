<!DOCTYPE html>
<html>
    <head>
        <title>User list</title>
    </head>
    <body>
        Welcome, admin!
        @if (count($users) == 0)
        <p color='red'> There are no records in the database!</p>
        @else
        <table style="border: 1px solid black">
            <tr>
                <td> ID </td>
                <td> Username </td>
                <td> E-mail </td>
                <td> </td>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td> {{ $user->id }} </td>
                <td> {{ $user->name }} </td>
                <td> {{ $user->email }} </td>
                <td>
                    <form method="POST"

                          action='{{action([App\Http\Controllers\AdminController::class, 'blockUser'],$user -> id) }}'>
                        @csrf @method('DELETE')
                        <input type="submit" value="Block user"></form> </td>
                <td>
                    <form method="POST"

                          action='{{action([App\Http\Controllers\AdminController::class, 'deleteUser'],$user -> id) }}'>
                        @csrf @method('DELETE')
                        <input type="submit" value="Delete user"></form> </td>
                @endforeach
        </table>
        @endif
<!--        <p> <input type="button" value="New Book" onclick="addCountry({})"> </p>
        <p> <input type="button" value="Search books" onclick="filterBooks({})"> </p>-->
<!--        <script> ///sample code for later
            function addCountry() {
                window.location.href = "/country/create";
            }
            function filterBooks() {
                window.location.href = "filter";
            }
        </script>-->
    </body>
</html>