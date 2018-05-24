<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Player extends Model{

    protected $table = 'players';

    public function get_player_avatar($id){
    	return DB::table($this->table)
    			->join('photos', 'photos.id', '=', 'players.avatar_id')
    			->where('players.id', $id)
    			->get()
    			->first();
    }

    public function get_player_cover($id){
    	return DB::table($this->table)
    			->join('photos', 'photos.id', '=', 'players.cover_id')
    			->where('players.id', $id)
    			->get()
    			->first();
    }

    public function get_goalkeepers(){
        return DB::table($this->table)
                ->join('photos', 'photos.id', '=', 'players.avatar_id')
                ->where('status', 'Prvi tim')
                ->where('position', 'Golman')
                ->get();
    }

    public function get_defenders(){
        return DB::table($this->table)
                ->join('photos', 'photos.id', '=', 'players.avatar_id')
                ->where('position', 'Štoper')
                ->orWhere('position', 'Levi bek')
                ->orWhere('position', 'Desni bek')
                ->orWhere('position', 'Defanzivni vezni')
                ->where('status', 'Prvi tim')
                ->get();
    }

    public function get_midfielders(){
        return DB::table($this->table)
                ->join('photos', 'photos.id', '=', 'players.avatar_id')
                ->where('position', 'Sredina')
                ->where('status', 'Prvi tim')
                ->orWhere('position', 'Ofanzivni vezni')
                ->where('status', 'Prvi tim')
                ->get();        
    }

    public function get_attackers(){
        return DB::table($this->table)
                ->join('photos', 'photos.id', '=', 'players.avatar_id')
                ->where([
                    ['status', 'Prvi tim'],
                    ['position', 'Napadač'],  
                ])
                ->get();         
    }

}
