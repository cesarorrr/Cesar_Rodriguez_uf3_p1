<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Token;

use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{

    /**
     * Read films from storage
     */
    public static function readFilms(): array
    {
        $filmsJson = Storage::json('/public/films.json');

        $filmsDDBB = Film::all();
        $filmsDDBBArray = json_decode(json_encode($filmsDDBB), true);

        $films = array_merge($filmsJson, $filmsDDBBArray);
        return $films;
    }
    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {
        $old_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Antiguas (Antes de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            //foreach ($this->datasource as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }
    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        dd($new_films);

        return view('films.list', ["films" => $new_films, "title" => $title]);
    }
    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            } else if ((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)) {
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            } else if (!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    // public function filmsByYear($year = null)
    // {
    //     $films_filtered = [];

    //     $title = "Listado de todas las pelis";
    //     $films = FilmController::readFilms();

    //     //if year and genre are null
    //     if (is_null($year))
    //         return view('films.list', ["films" => $films, "title" => $title]);

    //     //list based on year informed
    //     foreach ($films as $film) {
    //         if (!is_null($year) && $film['year'] == $year) {
    //             $title = "Listado de todas las pelis filtrado x año";
    //             $films_filtered[] = $film;
    //         }
    //     }
    //     return view("films.list", ["films" => $films_filtered, "title" => $title]);
    // }
    // public function filmsByGenre($genre = null)
    // {
    //     $films_filtered = [];

    //     $title = "Listado de todas las pelis";
    //     $films = FilmController::readFilms();

    //     //if year and genre are null
    //     if (is_null($genre))
    //         return view('films.list', ["films" => $films, "title" => $title]);

    //     //list based on genre informed
    //     foreach ($films as $film) {
    //         if (is_null($genre)) {
    //             $title = "Listado de todas las pelis filtrado x genereo";
    //             $films_filtered[] = $film;
    //         }
    //     }
    //     return view("films.list", ["films" => $films_filtered, "title" => $title]);
    // }
    // public function sortFilms()
    // {
    //     $title = "Listado de todas las pelis de nuevas a mas antiguas";
    //     $films = FilmController::readFilms();

    //     usort($films, function ($a, $b) {
    //         return $b['year'] - $a['year'];
    //     });

    //     return view("films.list", ["films" => $films, "title" => $title]);
    // }
    public function countFilms()
    {

        $title = "Number of movies";
        $films = FilmController::readFilms();

        $films = count($films);


        return view('films.count', ["films" => $films, "title" => $title]);
    }
    public function createFilm()
    {
        $exist = FilmController::isFilm($_POST["Nombre"]);
        if ($exist) {
            return view('welcome', ["error" => "Ya hay una pelicula registrada con este nombre"]);
        } else {
            $json_bbdd = Token::first();
            if ($json_bbdd) {
                $films = FilmController::readFilms();
                $film = [
                    'name' => $_POST['Nombre'],
                    'year' => $_POST['Ano'],
                    'genre' => $_POST['Genero'],
                    'country' => $_POST['Pais'],
                    'duration' => $_POST['Duracion'],
                    'img_url' => $_POST['Imagen'],
                ];
                $films[] = $film;
                $jsonFilms = json_encode($films, JSON_PRETTY_PRINT);
                Storage::put('/public/films.json', $jsonFilms);
            } else {
                $filmData = new Film([
                    'name' => $_POST['Nombre'],
                    'year' => $_POST['Ano'],
                    'genre' => $_POST['Genero'],
                    'country' => $_POST['Pais'],
                    'duration' => $_POST['Duracion'],
                    'img_url' => $_POST['Imagen'],
                ]);
                $filmData->save();
                $films = FilmController::readFilms();
            }
            // dd($json_bbdd);
            $json_bbdd->Json_BBDD = !$json_bbdd->Json_BBDD;
            $json_bbdd->save();
            $title = "Listado de todas las pelis";
            return view("films.list", ["films" => $films, "title" => $title]);
        }
    }
    public function isFilm($name = null): bool
    {
        return Film::where('name', $name)->exists();
    }
}
