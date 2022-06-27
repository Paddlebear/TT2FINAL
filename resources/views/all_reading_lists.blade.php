<!DOCTYPE html>
<!-- this is also the homepage. -->
<html>
    <head>
        <title>Reading Recs</title>
    </head>
    <body>
        @if (count($lists) == 0)
        <p color='red'> There are no records in the database!</p>
        @else
        <table style="border: 1px solid black">
            <tr>
                <td> Name </td>
                <td> By: </td>
                <td> Description </td>
                <td> </td>
            </tr>
            @foreach ($lists as $list)
            <tr>
                <td> {{ $list->listname }} </td>
                <td> {{ $list->name }} </td>
                <td> {{ $list->description }} </td>
                <td><input type="button" value="See list contents" onclick="seeList('{{$list->listname}}')"></td>
                <td><input type="button" value="Delete list" onclick="deleteList({{ $list->id }})"></td>
                @endforeach
        </table>
        @endif
        <p> <input type="button" value="See Books" onclick="seeBooks({})"> </p>
        <p> <input type="button" value="New List (in development)" onclick="addBook({})"> </p>
<!--        <p> <input type="button" value="Search books" onclick="filterBooks({})"> </p>-->
        <script> ///sample code for later
            function seeBooks() {
                window.location.href = "/books";
            }
            function addBook() {
                window.location.href = "/add_reading_list";
            }
            function deleteList(listID) {
                window.location.href = "/delete_reading_list/"+listID;
            }
            function seeBooks() {
                window.location.href = "/books";
            }
            function seeList(listname) {
                //var name = str_replace(' ', '_', $listname);
                window.location.href = "/reading_lists/" + listname; 
            }
//            function filterBooks() {
//                window.location.href = "filter";
//            }
        </script>
    </body>
</html>