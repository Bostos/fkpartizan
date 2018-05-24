<?php

namespace App\Http\Controllers;

use App\Goal;
use App\Player;
use App\Match;
use Illuminate\Http\Request;

class GoalController extends Controller{

    public function index(){
        $goals = new Goal();
        $this->data['goals'] = $goals::select('goals.*', 'goals.id as goal_id', 'seasons.year as season', 'competitions.name as competition','players.name as player', 'matches.*')
                                ->join('matches', 'goals.match_id', '=', 'matches.id')
                                ->join('players', 'goals.player_id', '=', 'players.id')
                                ->join('seasons', 'matches.season_id', '=', 'seasons.id')
                                ->join('competitions', 'matches.competition_id', '=', 'competitions.id')
                                ->orderBy('matches.date', 'desc')
                                ->get();
        $this->data['players'] = Player::orderBy('name')->get();
        $this->data['seasons'] = \App\Season::orderBy('year', 'desc')->get();
        $this->data['competitions'] = \App\Competition::all();
        $this->data['type'] = Goal::select('type')->distinct()->get();
        return view ('admin.pages.goals', $this->data);
    }

    public function create(){
        $players = Player::orderBy('name')->get();
        $matches = Match::orderBy('date', 'desc')->get();
        $this->data['players'] = $players;
        $this->data['matches'] = $matches;
        return view('admin.pages.create_goal', $this->data);
    }

    public function store(Request $request){
        $goal = new Goal();
        $goal->match_id = $request->utakmica;
        $goal->player_id = $request->igrac;
        $goal->type = $request->tip;
        $goal->minute = $request->minut;

        $request->validate([
            'minut' => 'required',
            'utakmica' => 'required',
            'igrac' => 'required',
            'tip' => 'required'
        ]);
        try{
            $goal->save();
            $goalID = $goal->id;
            $mec = Goal::find($goalID)->match;
            $igrac = Goal::find($goalID)->player;
            \Log::info('Dodat je novi gol, strelac je: '.$igrac->name.' u '.$goal->minute.' minutu. Gol je postigao na meču '.$mec->home_team.' - '.$mec->away_team);
            return back()->with('success', 'Gol je dodat.'); 
        }catch(\Exception $e){
            \Log::error('Greška prilikom dodavanja gola. '.$e);
            return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
        
    }

    public function show($id){
        //
    }

    public function edit($id){
        $goal = Goal::find($id);
        $this->data['goal'] = $goal;
        return view('admin.pages.edit_goal', $this->data);
    }

    public function update(Request $request, $id){
        $goal = Goal::find($id);
        $goal->minute = $request->minut;
        $goal->type = $request->tip;

        $request->validate([
            'minut' => 'required',
            'tip' => 'required'
        ]);

        try{
            $goal->save();
            $goalID = $goal->id;
            $mec = Goal::find($goalID)->match;
            $igrac = Goal::find($goalID)->player;
            \Log::info('Izmenjen je gol: '.$igrac->name.' u '.$goal->minute.' minutu. Gol je postignut na meču '.$mec->home_team.' - '.$mec->away_team.'. Utakica odigrana: '.date('d.m.Y', strtotime($mec->date)).'.');
            return redirect('admin/goals')->with('success', 'Gol je izmenjen.'); 
        }catch(\Exception $e){
            \Log::error('Greška prilikom izmene gola. '.$e);
            return redirect('admin/goals')->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }

    public function destroy($id){
        $goal = Goal::find($id);

        $gol = Goal::select('goals.*', 'goals.id as goal_id', 'seasons.year as season', 'competitions.name as competition','players.name as player', 'matches.*')
                                ->join('matches', 'goals.match_id', '=', 'matches.id')
                                ->join('players', 'goals.player_id', '=', 'players.id')
                                ->join('seasons', 'matches.season_id', '=', 'seasons.id')
                                ->join('competitions', 'matches.competition_id', '=', 'competitions.id')
                                ->where('goals.id', $id)
                                ->get()->first();
        try{
            Goal::destroy($id);
            \Log::info('Obrisan je gol: '.$gol->player.' ('.$gol->minute.' min), postignut na meču '.$gol->home_team.' - '.$gol->away_team.'. ('.date('d.m.Y', strtotime($gol->date)).')');
            return back()->with('success', 'Gol je obrisan.');
        }catch(\Exception $e){
            \Log::error('Greškla prilikom brisanja gola. '.$e);
            return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }

    public function filter(Request $request){
        $this->data['competitions'] = \App\Competition::all();
        $this->data['seasons'] = \App\Season::orderBy('year', 'desc')->get();
        $this->data['players'] = Player::orderBy('name')->get();
        $this->data['type'] = Goal::select('type')->distinct()->get();
        $query = Goal::select('goals.*', 'goals.id as goal_id', 'seasons.year as season', 'competitions.name as competition','players.name as player', 'matches.*')
                                ->join('matches', 'goals.match_id', '=', 'matches.id')
                                ->join('players', 'goals.player_id', '=', 'players.id')
                                ->join('seasons', 'matches.season_id', '=', 'seasons.id')
                                ->join('competitions', 'matches.competition_id', '=', 'competitions.id');

        if($request->get('sezona')!=''){
            $query->where('matches.season_id', $request->sezona);
        }
        if($request->get('takmicenje')!=''){
            $query->where('matches.competition_id', $request->takmicenje);
        }
        if($request->get('igrac')!=''){
            $query->where('goals.player_id', $request->igrac);
        }
        if($request->get('tip')!=''){
            $query->where('goals.type', $request->tip);
        }

        $query->orderBy('matches.date', 'desc');
        $goals = $query->get();

        if($goals->isEmpty()){
            $this->data['info'] = 'Nema golova za izabrane stavke.';
        }

        $request->flashOnly(['sezona', 'takmicenje', 'igrac', 'tip']);
        $this->data['goals'] = $goals;
        return view ('admin.pages.goals', $this->data);
    }
}
