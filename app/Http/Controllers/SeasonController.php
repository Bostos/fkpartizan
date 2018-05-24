<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Season;

class SeasonController extends Controller{

    public function index(){
        $this->data['seasons'] = Season::all();
        return view('admin.pages.seasons', $this->data);
    }

    public function create(){
        return view('admin.pages.create_season');
    }

    public function store(Request $request){
        $season = new Season();
        $season->year = $request->sezona;
        $request->validate(['sezona' => 'required|min:7']);
        try{
            $season->save();
            \Log::info('Dodata je sezona: '.$season->year.'.');
            return back()->with('success', 'Sezona je dodata.'); 
        }catch(\Exception $e){
            \Log::error('Greškla prilikom dodavanja sezone. '.$e);
            return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        $season = Season::find($id);
        try{
            Season::destroy($id);
            \Log::info('Obrisana je sezona: '.$season->year.'.');
            return back()->with('success', 'Sezona je obrisana.'); 
        }catch(\Exception $e){
            \Log::error('Greškla prilikom brisanja sezone. '.$e);
            return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }
}
