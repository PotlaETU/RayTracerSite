<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Favori;
use App\Models\Scene;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Parsedown;

class SceneController extends Controller
{
    public function index(Request $request) {
        Log::info('Hello from index');
        $cat = $request->input('cat', null);
        $value = $request->cookie('cat', null);
        if (!isset($cat)) {
            if (!isset($value)) {
                $scenes = Scene::all();
                $cat = 'All';
                Cookie::expire('cat');
            } else {
                $scenes = Scene::where('equipe', $value)->get();
                $cat = $value;
                Cookie::queue('cat', $cat, 10);            }
        } else {
            if ($cat == 'All') {
                $scenes = Scene::all();
                Cookie::expire('cat');
            } else {
                $scenes = Scene::where('equipe', $cat)->get();
                Cookie::queue('cat', $cat, 10);
            }
        }
        $equipes = Scene::distinct('equipe')->pluck('equipe');
        return view('scenes.index',
            ['titre' => "Liste des scenes", 'scenes' => $scenes, 'cat' => $cat, 'equipes' => $equipes]);
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $parseDown = new ParseDown();
        $userId = Auth::user()->id;
        $scene = Scene::find($id);
        $isFavorite = Favori::where('idUser', $userId)
            ->where('idScene', $scene->id)
            ->exists();
        $commentaires = Commentaire::where('idScene', $scene['id'])->orderby('created_at', 'desc')->get();
        $titre = $request->get('action', 'show') == 'show' ? "Détails d'une scene" : "Suppression d'une scene";
        return view('scenes.show', ['titre' => $titre, 'scene' => $scene, 'action' => $request->get('action', 'show'), 'parseDown' => $parseDown, 'commentaires' => $commentaires, 'isFavorite' => $isFavorite]);

        //$sport = Sport::find($id);
        // return view('sports.show', ['tache' => $tache,'titre'=>"Détails d'une tâche", 'action'=>"Editer"]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        //
    }

    public function upload(Request $request, $id) {
        //
    }
}