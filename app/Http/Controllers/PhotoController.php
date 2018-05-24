<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller{
    
    public function index(){
        $avatars = Photo::where('type', 'avatar')->get();
        $covers = Photo::where('type', 'cover')->get();
        $logos = Photo::where('type', 'logo')->get();
        $flags = Photo::where('type', 'flag')->get();
        $this->data['avatars'] = $avatars;
        $this->data['covers'] = $covers;
        $this->data['logos'] = $logos;
        $this->data['flags'] = $flags;
        return view('admin.pages.photos', $this->data);
    }

    public function create(){
        return view('admin.pages.create_photo');
    }

    public function store(Request $request){
        $photo = new Photo();
        $photo->name = $request->naslov;
        $photo->type = $request->tip;
        $photoFile = $request->file('slika');
        $storagePath = 'images/'.$photo->type.'s';
        $messages = [
            'required' => 'Polje :attribute je obavezno',
            'image' => 'Fajl mora biti slika',
            'mimes' => 'Fajl mora biti u jpeg, jpg, png ili gif formatu',
            'max' => 'Slika može biti maksimalne veličine 1 MB'
        ];
        $request->validate([
                'naslov' => 'required',
                'tip' => 'required',
                'slika' => 'required|image|mimes:jpeg,jpg,png,gif|max:1000',
        ], $messages);

        $request->flash();
        
        try{
            $fileName = $photoFile->getClientOriginalName();
            $photoPath = $photoFile->storeAs($storagePath, $fileName);
            $photo->path = $photoPath;
            $photo->save();
            \Log::info('Dodata je '.$photo->type.' slika: '.$fileName);
            return back()->with('success', 'Slika je dodata.');
        }
         catch(\Exception $e){
            \Log::error('Greškla prilikom dodavanja slike. '.$e);
            return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }


    public function show($id){
        //
    }

    public function edit($id){
        $photo = Photo::find($id);
        $type = $photo->type;
        if($type=='avatar'){
            $this->data['avatar'] = $photo;
            return view ('admin.pages.edit_photo', $this->data);
        }
        if($type=='cover'){
            $this->data['cover'] = $photo;
            return view ('admin.pages.edit_photo', $this->data);
        }
        if($type=='logo'){
            $this->data['logo'] = $photo;
            return view ('admin.pages.edit_photo', $this->data);
        }
        if($type=='flag'){
            $this->data['flag'] = $photo;
            return view ('admin.pages.edit_photo', $this->data);
        }
    }

    public function update(Request $request, $id){
        $photo = Photo::find($id);
        $staroIme = $photo->name;
        $tip = $request->tip;
        if($request->filled('naslov')){
           $photo->name = $request->naslov;
        }
        $messages = [
            'naslov.required' => 'Unesite naziv slike',
            'image' => 'Fajl mora biti slika',
            'mimes' => 'Fajl mora biti u jpeg, jpg, png ili gif formatu',
            'max' => 'Slika može biti maksimalne veličine 1 MB'
        ];
        $request->validate([
            $tip => 'image|mimes:jpeg,jpg,png,gif|max:1000',
            'naslov' => 'required'
        ], $messages);

        if($request->hasFile($tip)){
            try{
                if(($tip=='avatar'||$tip=='cover') && $photo->name=='noimage'){
                    $photoFile = $request->$tip;
                    $storagePath = 'images/'.$tip.'s';
                    $fileName = $photoFile->getClientOriginalName();
                    $photoPath = $photoFile->storeAs($storagePath, $fileName);
                    $photo->path = $photoPath;
                    $photo->type = $request->tip;
                    $photo->save();
                    \Log::info('Promenjena je slika: '.$fileName);
                    $idPohoto = $photo->id;
                    $player = \Players::where('name', $fileName);
                    $player->avatar_id = $idPhoto;
                    $player->save();
                    \Log::info('Izmenjen je igrač: '.$player->name);
                    return redirect('photos')->with('success', 'Slika je promenjena.');   
                }
                else{
                    $photoFile = $request->$tip;
                    $storagePath = 'images/'.$tip.'s';
                    \Storage::delete($photo->path);
                    $fileName = $photoFile->getClientOriginalName();
                    $photoPath = $photoFile->storeAs($storagePath, $fileName);
                    $photo->path = $photoPath;
                    $photo->type = $request->tip;
                    $photo->save();
                    \Log::info('Promenjena je slika: '.$fileName);
                    return redirect('photos')->with('success', 'Slika je promenjena.');   
                }
            }catch(\Exception $e){
                \Log::error('Greškla prilikom izmene slike. '.$e);
                return redirect('photos')->with('error', 'Došlo je do greške, pokušajte kasnije.');
            }

        }
        else{
            try{
                $photo->save();
                \Log::info('Promenjen je naziv slike: "'.$staroIme.'" u "'.$photo->name.'"');
                return redirect('admin/photos')->with('success', 'Naziv slike je promenjen.');  
            }
            catch(\Exception $e){
                \Log::error('Greškla prilikom izmene naziva slike. '.$e);
                return redirect('admin/photos')->with('error', 'Došlo je do greške, pokušajte kasnije.');
            }
        }
    }

    public function destroy($id){
        $photo = Photo::find($id);
        try{
            //if avatar or cover, find player with that avatar_id/cover_id and update it to noimage (??)
            \Storage::delete($photo->path);
            Photo::destroy($id);
            \Log::info('Obrisana je slika: '.$photo->name);
            return back()->with('success', 'Slika je obrisana.');
        }catch(\Exception $e){
            \Log::error('Greškla prilikom brisanja slike. '.$e);
            return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }

    public function find($keyword=''){
        $result = Photo::where('name', 'LIKE', '%'.$keyword.'%')->where('type', 'logo')->get();
        return response()->json($result);
    }
}
