<!DOCTYPE html>
<html>
    <head>
        <title>Update book</title>
    </head>
    <body>
        Update record with title <b>{{ $book->booktitle }}</b>:
        <form method="POST" action="/book/update">
            @csrf
            <input type="hidden" name="id" value="{{ $book->id }}">
            <label for="booktitle">Title: </label>
            <input type="text" name="booktitle" id="booktitle" value="{{ $book->booktitle }}">
            <label for="author">Author: </label>
            <input type="text" name="author" id="author" value="{{ $book->author }}">
            <label for="publicationyear">Publication year: </label>
            <input type="number" name="publicationyear" id="publicationyear" value="{{ $book->publicationyear }}">
            <label for="genre_select">Genre: </label>
            <select id="genre_select" name="genre_id"></select>
            <input type="submit" value="update">
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
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                var genres = <?= json_encode($genres) ?>;
                var genre_s = document.getElementById("genre_select");
                var lookup = {};
                var idents = {};
                //console.log(countries);
                //var countryname;
                for (let i in genres) { // for every item in the data - every piece of statistic info
                    let genre = genres[i].genrename; // read country from data
                    let ident = genres[i].id;
                    //console.log(country);
                    if (genre && !(genre in lookup)) { // if the continet hasn't been previously processed (is not present in lookup)
                        lookup[genre] = {}; // add a new continent to the lookup
                        idents[ident] = {};
                    }
                }
                //console.log(lookup); // uncomment this line if you want to see the result in the console
                var genrelist = Object.keys(lookup);
                var genreidlist = Object.keys(idents);
                console.log(genrelist); // uncomment this line if you want to see the result in the console
                console.log(genreidlist); // uncomment this line if you want to see the result in the console
                for (let i in genrelist) { // for every continent
                let opt = document.createElement('option'); // create a new OPTION element
                opt.innerHTML = genrelist[i]; // fill the text with the continent name
                opt.value = genreidlist[i]; // fill the value with the continent name
                genre_s.appendChild(opt); // add newly created OPTION to the continent SELECT element
            }
            });
        </script>
    </body>
</html>