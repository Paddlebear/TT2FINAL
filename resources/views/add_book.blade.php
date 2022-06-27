<!DOCTYPE html>
<html>
    <head>
        <title>Add new book to system - Reading Recs</title>
    </head>
    <body>
        <p>We will add a book to the Reading Recs database:</p>
        <form method="POST"
              action="{{action([App\Http\Controllers\BookController::class, 'store']) }}">
            @csrf
            <label for="booktitle">Book Name: </label>
            <input type="text" name="booktitle" id="booktitle">
            <label for="author">Author: </label>
            <input type="text" name="author" id="author">
            <label for="publicationyear">Publication Year </label>
            <input type="number" name="publicationyear" id="publicationyear">
            <label for="genre_select">Genre: </label>
            <select id="genre_select" name="genre_id"></select> <!-- make a genre table and a spinner a la book search from the other project -->
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