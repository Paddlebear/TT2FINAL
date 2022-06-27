<!DOCTYPE html>
<html>
    <head>
        <title>{{$list[0]->listname}} - Reading Recs</title>
    </head>
    <body>

    {{$list[0]->listname}} by {{$list[0]->name}}:
        @if (count($books) == 0)
        <p color='red'>This reading list is empty.</p>
        @else
        <table style="border: 1px solid black">
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
        <p color='red'>This reading list has no tags.</p>
        @else
        <table style="border: 1px solid black">
            @foreach ($tags as $tag)
            <tr>
                <td> {{ $tag->tagname }} </td>
                @endforeach
        @endif
        </table>
    </body>
</html>