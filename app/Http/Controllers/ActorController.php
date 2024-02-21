<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{

    /**
     * Read actors from bbdd
     */
    public static function readActors()
    {
        $actors = Actor::where('name', 'surname', 'birtdate', 'country',  'img_url')->paginate(10);
        $actorsArray = json_decode(json_encode($actors), true);


        return $actorsArray;
    }

    public function listActors()
    {

        $title = "Listado de todos los actores";
        $actors = ActorController::readActors();
        return view("actors.list", ["actors" => $actors, "title" => $title]);
    }
    public function listActorsByDecade(Request $request)
    {
        $decade = $request->input("decade");
        $title = "Listado de los actores de la decada";

        if ($decade === null) {
            $decade = date('Y') - date('Y') % 10;
        }

        $startYear = $decade;
        $endYear = $decade + 9;

        $actors = Actor::whereYear('birtdate', '>=', $startYear)
            ->whereYear('birtdate', '<=', $endYear)
            ->get();
        $actorsArray = json_decode(json_encode($actors), true);

        return view("actors.list", ["actors" => $actorsArray, "title" => $title]);
    }
    public function countActors()
    {

        $title = "Contador Actores";
        $actors = Actor::count();
        return view("actors.count", ["actors" => $actors, "title" => $title]);
    }
    public function deleteActor($id)
    {
        $actor = Actor::find($id);
        $actor->delete();
        if ($actor) {
            return response()->json(['action' => $actor, "status" => "true"]);
        } else {
            return response()->json(['action' => $actor, "status" => "false"]);
        }
    }
}
