<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model{
    protected $table = 'goals';

    public function match(){
        return $this->belongsTo('App\Match', 'match_id');
    }

    public function player(){
        return $this->belongsTo('App\Player', 'player_id');
    }

    public function goalscorers($competition){
    	return 	\DB::table($this->table)
    				->select('players.name', \DB::raw('count(goals.player_id) as goals'))
    				->join('players', 'goals.player_id', '=', 'players.id')
    				->join('matches', 'goals.match_id', '=', 'matches.id')
    				->join('competitions', 'matches.competition_id', '=', 'competitions.id')
    				->where('competitions.id', $competition)
    				->groupBy('players.name')
    				->orderBy('goals', 'desc')
    				->get();
    }
    
}
