<?php

namespace App\Http\Controllers;

use App\Player;
use App\Photo;
use Illuminate\Http\Request;

class PlayerController extends Controller{

    private $data;

    public function index(Request $request){
        $players = Player::select('players.*', 'photos.path as flag')->where('status', 'Prvi tim')
                ->join('photos', 'players.country', '=', 'photos.name')
                ->get();
        $positions = Player::select('position as name')->distinct()->get();
        $status = Player::select('status as name')->distinct()->get();
        $country = Player::select('country')->distinct()->get();

        $kriterijum = $request->sort;
        $sorted = $players->sortByDesc($kriterijum);
        $request->flashOnly(['sort']);
        $this->data['players'] = $sorted;
        $this->data['positions'] = $positions;
        $this->data['status'] = $status;
        $this->data['countries'] = $country;
        return view ('admin.pages.players', $this->data);
    }

    public function create(){
        return view ('admin.pages.create_player');
    }

    public function store(Request $request){
    
        $player = new Player();
        $photo = new Photo(); $photo2 = new Photo();
        $player->name = $request->ime_prezime;
        $player->country = $request->drzava;
        $player->position = $request->pozicija;
        $player->birth_date = $request->datum;
        $player->apps = $request->nastupi;
        $player->goals = $request->golovi;
        $player->debut = $request->prvi_nastup;
        $player->height = $request->visina;
        $player->weight = $request->tezina;
        $player->status = $request->status;
        $player->number = $request->broj;
        $avatar = $request->avatar;
        $cover = $request->cover;
        $player->previous_club = $request->prethodni_klub;
        $player->date_of_signing = $request->datum_dolaska;
        $player->date_of_leaving = $request->datum_odlaska;

        $validation = $request->validate([
            'ime_prezime' => 'required',
            'drzava' => 'required',
            'nastupi' => 'required',
            'golovi' => 'required',
            'visina' => 'required',
            'tezina' => 'required',
            'broj' => 'required',
            'prethodni_klub' => 'required',
            'datum' => 'required',
            'pozicija' => 'required',
            'status' => 'required',
            'datum_dolaska' => 'required',
            'prvi_nastup' => 'required'
        ]);

        if(!$validation){
            $request->flash();
        }

        try{
            if($avatar!=null && $cover==null){
                $noImagePath = 'images/covers/'.$player->name.'.jpg';
                \Storage::copy('images/covers/noimage.jpg', $noImagePath);
                $avatarName = $avatar->getClientOriginalName();
                $avatarPath = $request->file('avatar')->storeAs('/images/avatars', $avatarName);
                $photo->name = pathinfo($avatarName, PATHINFO_FILENAME); /* Ime slike bez ekstenzije */
                $photo->path = $avatarPath;
                $photo->type= 'avatar';
                $photo->save();
                \Log::info('Dodata je avatar slika: '.$avatarName);
                $igrac = $request->ime_prezime;
                $photo2->name = $igrac;
                $photo2->path = $noImagePath;
                $photo2->type= 'cover';
                $photo2->save();
                \Log::info('Dodata je cover slika: '.$igrac.'.jpg');
                $coverID = $photo2->id;
                $avatarID = $photo->id;
                $player->avatar_id = $avatarID;
                $player->cover_id = $coverID;
                $player->save();
                \Log::info('Dodat je igrač: '.$player->name);
                return back()->with('success', 'Igrač je uspešno dodat.'); 
            }
            elseif($avatar==null && $cover!=null){
                $noImagePath = 'images/avatars/'.$player->name.'.jpg';
                \Storage::copy('images/avatars/noimage.jpg', $noImagePath);
                $coverName = $cover->getClientOriginalName();
                $coverPath = $request->file('cover')->storeAs('/images/covers', $coverName);
                $photo2->name = pathinfo($coverName, PATHINFO_FILENAME); /* Ime slike bez ekstenzije */
                $photo2->path = $coverPath;
                $photo2->type= 'cover';
                $photo2->save();
                \Log::info('Dodata je cover slika: '.$igrac.'.jpg');
                $igrac = $request->ime_prezime;
                $photo->name = $igrac;
                $photo->path = $noImagePath;
                $photo->type= 'avatar';
                $photo->save();
                \Log::info('Dodata je avatar slika: '.$igrac.'.jpg');
                $coverID = $photo2->id;
                $avatarID = $photo->id;
                $player->cover_id = $coverID;
                $player->avatar_id = $avatarID;
                $player->save();
                \Log::info('Dodat je igrač: '.$player->name);
                return back()->with('success', 'Igrač je uspešno dodat.'); 
            }
            elseif($cover!=null && $avatar!=null){
                $coverName = $cover->getClientOriginalName();
                $avatarName = $avatar->getClientOriginalName();
                $avatarPath = $request->file('avatar')->storeAs('/images/avatars', $avatarName);
                $coverPath = $request->file('cover')->storeAs('/images/covers', $coverName);
                if($avatarPath){
                    $photo->name = pathinfo($avatarName, PATHINFO_FILENAME);
                    $photo->path = $avatarPath;
                    $photo->type= 'avatar';
                    $photo->save();
                    \Log::info('Dodata je avatar slika: '.$avatarName);
                    $avatarId = $photo->id;
                }
                if($coverPath){
                    $photo2->name = pathinfo($coverName, PATHINFO_FILENAME);
                    $photo2->path = $coverPath;
                    $photo2->type= 'cover';
                    $photo2->save();
                    \Log::info('Dodata je cover slika: '.$coverName);
                    $coverId = $photo2->id;
                }
                if($avatarId && $coverId){
                    $player->avatar_id = $avatarId;
                    $player->cover_id = $coverId;
                    $player->save();
                    \Log::info('Dodat je igrač: '.$player->name);
                    return back()->with('success', 'Igrač je uspešno dodat.');  
                }
            }
            else{
                $noCoverPath = 'images/covers/'.$player->name.'.jpg';
                \Storage::copy('images/covers/noimage.jpg', $noCoverPath);
                $noAvatarPath = 'images/avatars/'.$player->name.'.jpg';
                \Storage::copy('images/avatars/noimage.jpg', $noAvatarPath);
                $imeIgraca = $request->ime_prezime;
                $photo->name = $imeIgraca;
                $photo->path = $noAvatarPath;
                $photo->type= 'avatar';
                $photo->save();
                \Log::info('Dodata je avatar slika: '.$imeIgraca.'.jpg');
                $photo2->name = $imeIgraca;
                $photo2->path = $noCoverPath;
                $photo2->type= 'cover';
                $photo2->save();
                \Log::info('Dodata je cover slika: '.$imeIgraca.'.jpg');
                $avatarID = $photo->id;
                $coverID = $photo2->id;
                $player->avatar_id = $avatarID;
                $player->cover_id = $coverID;
                $player->save();
                \Log::info('Dodat je igrač: '.$player->name);
                return back()->with('success', 'Igrač je uspešno dodat.');  
            }
        }
        catch(\Exception $e){
            \Log::error('Greška prilikom dodavanja igrača. '.$e);
            return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }

    public function show($id){
        
    }

    public function edit($id){
        $player =  Player::find($id);
        $this->data['player'] = $player;
        $this->data['avatar'] = $player->get_player_avatar($id);
        return view ('admin.pages.edit_player', $this->data);
    }

    public function update(Request $request, $id){
        $player =  Player::find($id);

        $player->name = $request->ime_prezime;
        $player->country = $request->drzava;
        $player->position = $request->pozicija;
        $player->birth_date = $request->datum;
        $player->apps = $request->nastupi;
        $player->goals = $request->golovi;
        $player->debut = $request->prvi_nastup;
        $player->height = $request->visina;
        $player->weight = $request->tezina;
        $player->status = $request->status;
        $player->number = $request->broj;
        $player->previous_club = $request->prethodni_klub;
        $player->date_of_signing = $request->datum_dolaska;
        $player->date_of_leaving = $request->datum_odlaska;

        $request->validate([
                'ime_prezime' => 'required',
                'drzava' => 'required',
                'nastupi' => 'required',
                'golovi' => 'required',
                'visina' => 'required',
                'tezina' => 'required',
                'broj' => 'required',
                'prethodni_klub' => 'required',
                'datum' => 'required',
                'pozicija' => 'required',
                'status' => 'required',
                'datum_dolaska' => 'required',
                'prvi_nastup' => 'required'
            ]);

        try{
            $player->save(); 
            \Log::info('Izmenjen je igrač: '.$player->name);
            return redirect('admin/players')->with('success', 'Podaci za '.$player->name.' su ažurirani.');  
        }
        catch(\Exception $e){
            Log::error('Greška prilikom izmene igrača. '.$e);
            return redirect('admin/players')->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
        
    }

    public function destroy($id){
        //
    }

    public function filter(Request $request){
        $positions = Player::select('position as name')->distinct()->get();
        $status = Player::select('status as name')->distinct()->get();
        $country = Player::select('country')->distinct()->get();

        $query = Player::select('players.*', 'photos.path as flag')
                    ->join('photos', 'players.country', '=', 'photos.name');

        if($request->get('pozicija')!=''){
            $query->where('position', $request->pozicija);
        }
        if($request->get('status')!=''){
            $query->where('status', $request->status);
        }
        if($request->get('drzava')!=''){
            $query->where('country', $request->drzava);
        }
        $players = $query->get();

        if($players->isEmpty()){
            $this->data['info'] = 'Ne postoji igrač sa izabranim kriterijumima.';
        }
        $request->flashOnly(['status', 'pozicija', 'drzava']);
        $this->data['players'] = $players;
        $this->data['positions'] = $positions;
        $this->data['status'] = $status;
        $this->data['countries'] = $country;
        return view ('admin.pages.players', $this->data);
    }

    public function create_cap(){
        $this->data['players'] = Player::where('status', 'Prvi tim')->orderBy('name', 'asc')->get();
        return view ('admin.pages.create_cap', $this->data);
    }

    public function store_cap(Request $request){
        $player = new Player();
        $players_id[] = $request->igrac;

        try{
            foreach($players_id as $pID){
            $player = Player::find($pID);
                foreach($player as $p){
                    $p->apps = ($p->apps) + 1;
                    $p->save();
                }
            }
            \Log::info('Nastupi su dodati.');
            return redirect('admin/players')->with('success', 'Nastupi su ažurirani.');  
        }
        catch(\Exception $e){
            Log::error('Greška prilikom dodavanja nastupa. '.$e);
            return redirect('admin/players')->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }

    /*public function sort(Request $request){
        $players = Player::select('players.*', 'photos.path as flag')->where('status', 'Prvi tim')
                ->join('photos', 'players.country', '=', 'photos.name')
                ->get();

        $kriterijum = $request->sort;
        $sorted = $players->sortByDesc($kriterijum);

        $positions = Player::select('position as name')->distinct()->get();
        $status = Player::select('status as name')->distinct()->get();
        $country = Player::select('country')->distinct()->get();

        $this->data['players'] = $sorted;
        $this->data['positions'] = $positions;
        $this->data['status'] = $status;
        $this->data['countries'] = $country;
        return view ('admin.pages.players', $this->data);
    }*/
}
