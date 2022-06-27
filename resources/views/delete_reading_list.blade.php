<!DOCTYPE html>
<html>
    <head>
        <title>Delete a reading list //do the swirly brackets for the name thing, same in routing</title>
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