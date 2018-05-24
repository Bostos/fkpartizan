<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model{
    protected $table = 'matches';

    public function get_all(){
    	return \DB::table($this->table)
    			->select('matches.*', 'seasons.year', 'competitions.name')
    			->join('seasons', 'matches.season_id', '=', 'seasons.id')
    			->join('competitions', 'matches.competition_id', '=', 'competitions.id')
                ->orderBy('matches.date', 'desc')
    			->get();
    }

    public function get_one($id){
        return \DB::table($this->table)
                ->select('matches.*', 'seasons.year', 'competitions.name')
                ->join('seasons', 'matches.season_id', '=', 'seasons.id')
                ->join('competitions', 'matches.competition_id', '=', 'competitions.id')
                ->where('matches.id', $id)
                ->get()->first();
    }

    public function last_match(){
        return \DB::table($this->table)
                ->select('matches.*', 'competitions.name')
                ->join('competitions', 'matches.competition_id', '=', 'competitions.id')
                ->whereNotNull('matches.home_goals')
                ->orderBy('matches.date', 'desc')
                ->first();
    }

    public function next_match(){
        return \DB::table($this->table)
                ->select('matches.*', 'competitions.name')
                ->join('competitions', 'matches.competition_id', '=', 'competitions.id')
                ->whereNull('matches.home_goals')
                ->orderBy('matches.date', 'asc')
                ->first();
    }

    public function get_competition_matches($id){
        return \DB::table($this->table)
                ->where('competition_id', $id)
                ->orderBy('date', 'desc')
                ->get();
    }

    public function goal(){
    	 return $this->hasMany('App\Goals', 'match_id');
    }

    public function get_clubs(){
        return \DB::table($this->table)
                ->select('home_team as name')
                ->where('away_team', '!=', 'Partizan')
                ->orWhere('home_team', '!=', 'Partizan')
                ->groupBy('name')
                ->get();
    }
}
