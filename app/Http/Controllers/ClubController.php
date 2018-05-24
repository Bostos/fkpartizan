<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Club;
use App\Photo;

class ClubController extends Controller{
    public function index(){
        $club = new Club();
        $this->data['clubs'] = $club->get_all();
        return view ('admin.pages.clubs', $this->data);
    }

    public function create(){
        return view ('admin.pages.create_club');
    }

    public function store(Request $request){
        $club = new Club(); $photo = new Photo();
        $club->name = $request->ime;
        $logo = $request->file('logo');

        $request->validate([
            'ime' => 'required',
            'logo' => 'required|image|mimes:jpeg,jpg,png,gif|max:500'
        ]);
        $fileName = $logo->getClientOriginalName();

        try{
            //Upload slike na server
            $logo_path = $logo->storeAs('/images/logos', $fileName);
            //Dodavanje slike u bazu
            $photo->name = $request->ime;
            $photo->path = $logo_path;
            $photo->type = 'logo';
            $photo->save();
            $logoID = $photo->id;
            //Dodavanje kluba
            $club->logo_id = $logoID;
            $club->save();
            \Log::info('Dodat je klub: '.$club->name.'.');
            return back()->with('success', 'Klub je dodat.'); 
        }catch(\Exception $e){
            \Log::error('Greška prilikom dodavanja kluba. '.$e);
            return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }

    public function show($id){
        //
    }

    public function edit($id){
        $club = Club::find($id);
        $this->data['club'] = $club;
        return view ('admin.pages.edit_club', $this->data);
    }

    public function update(Request $request, $id){
        $club = Club::find($id);
        $club->name = $request->naziv;
        $request->validate(['naziv' => 'required|max:50']);
        try{
            $club->save();
            \Log::info('Izmenjen je klub: '.$club->name.'.');
            return redirect('admin/clubs')->with('success', 'Klub je izmenjen.'); 
        }catch(Exception $e){
            \Log::error('Greškla prilikom izmene kluba. '.$e);
            return redirect('admin/clubs')->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }

    public function destroy($id){
        //
    }
}
