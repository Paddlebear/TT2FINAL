<!DOCTYPE html>
<html>
    <head>
        <title>New reading list - Reading Recs</title>
    </head>
    <body>
        We will add a new list to the system (feature is still in development):
        <form method="POST"
              action="{{action([App\Http\Controllers\ReadingListController::class, 'store']) }}">
            @csrf
            <input type="hidden" name="user_id" value=1>
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