<?php

namespace App\Http\Controllers;

use App\Match;
use App\Season;
use App\Competition;
use Illuminate\Http\Request;

class MatchController extends Controller{

    public function index(){
        $matches = new Match();
        $this->data['matches'] = $matches->get_all();
        $this->data['competitions'] = Competition::all();
        $this->data['seasons'] = Season::orderBy('year', 'desc')->get();
        $this->data['clubs'] = \App\Club::all();
        return view ('admin.pages.matches', $this->data);
    }

    public function create(){
        $seasons = Season::all();
        $competitions = Competition::all();
        $this->data['seasons'] = $seasons;
        $this->data['competitions'] = $competitions;
        return view ('admin.pages.create_match', $this->data);
    }

    public function store(Request $request){
        $match = new Match();
        $match->home_team  = $request->domacin;
        $match->away_team  = $request->gost;
        $match->home_goals = $request->golovi_d;
        $match->away_goals = $request->golovi_g;
        $match->home_scorers = $request->strelci_d;
        $match->away_scorers = $request->strelci_g;
        $match->competition_id = $request->takmicenje;
        $match->round = $request->runda;
        $match->place = $request->mesto;
        $match->date = $request->datum;
        $match->season_id = $request->sezona;
        $match->highlights = $request->highlights;
        $match->home_logo = 'images/logos/'.mb_strtolower($request->domacin, 'UTF-8').'.png';
        $match->away_logo = 'images/logos/'.mb_strtolower($request->gost, 'UTF-8').'.png';

        $request->validate([
                'domacin' => 'required',
                'gost' => 'required',
                'takmicenje' => 'required',
                'mesto' => 'required',
                'datum' => 'required',
                'sezona' => 'required'
            ]);

        try{
           $match->save();
           \Log::info('Dodata je utakmica: '.$match->home_team.' - '.$match->away_team);
           return back()->with('success', 'Utakmica je uspešno dodata.');  
        }
        catch(Exception $e){
            \Log::error('Greškla prilikom dodavanja utakmice. '.$e);
            return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
        
    }

    public function show($id){
        $this->data['nav'] = \App\Menu::tree();
        $match = new Match();
        $this->data['match'] = $match->get_one($id);
        return view ('pages.single_match', $this->data);
    }

    public function edit($id){
        $match = Match::find($id);
        $seasons = Season::all();
        $competitions = Competition::all();
        $this->data['seasons'] = $seasons;
        $this->data['competitions'] = $competitions;
        $this->data['match']= $match;
        return view ('admin.pages.edit_match', $this->data);
    }

    public function update(Request $request, $id){
        $match = Match::find($id);
        $match->home_team  = $request->domacin;
        $match->away_team  = $request->gost;
        $match->home_goals = $request->golovi_d;
        $match->away_goals = $request->golovi_g;
        $match->home_scorers = $request->strelci_d;
        $match->away_scorers = $request->strelci_g;
        $match->competition_id = $request->takmicenje;
        $match->round = $request->runda;
        $match->place = $request->mesto;
        $match->date = $request->datum;
        $match->season_id = $request->sezona;
        $match->highlights = $request->highlights;

        $request->validate([
                'domacin' => 'required',
                'gost' => 'required',
                'takmicenje' => 'required',
                'mesto' => 'required',
                'datum' => 'required',
                'sezona' => 'required'
            ]);

        try{
           $match->save();
           \Log::info('Izmenjena je utakmica: '.$match->home_team.' - '.$match->away_team);
           return redirect('admin/matches')->with('success', 'Utakmica je izmenjena.'); 
        }
        catch(\Exception $e){
            \Log::error('Greškla prilikom izmene utakmice. '.$e);
            return redirect('admin/matches')->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
        
    }

    public function destroy($id){
        $match = Match::find($id);
        try{
            Match::destroy($id);
            \Log::info('Obrisana je utakmica: '.$match->home_team.' - '.$match->away_team);
            return back()->with('success', 'Utakmica je obrisana.');
        }catch(\Exception $e){
            \Log::error('Greškla prilikom brisanja utakmice. '.$e);
            return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }

    public function filter(Request $request){
        $match = new Match();
        $this->data['competitions'] = Competition::all();
        $this->data['seasons'] = Season::orderBy('year', 'desc')->get();
        $this->data['clubs'] = \App\Club::all();

        $query = Match::select('matches.*', 'seasons.year', 'competitions.name')
                        ->join('seasons', 'matches.season_id', '=', 'seasons.id')
                        ->join('competitions', 'matches.competition_id', '=', 'competitions.id');

        if($request->get('sezona')!=''){
            $query->where('season_id', $request->sezona);
        }
        if($request->get('takmicenje')!=''){
            $query->where('competition_id', $request->takmicenje);
        }
        if($request->get('klub')!=''){
            $query->where('away_team', $request->klub);
            $query->orWhere('home_team', $request->klub);
        }
        $query->orderBy('date', 'desc');
        $matches = $query->get();

        if($matches->isEmpty()){
            $this->data['info'] = 'Nema utakmica za izabrane stavke.';
        }

        $request->flashOnly(['sezona', 'takmicenje']);
        $this->data['matches'] = $matches;
        return view ('admin.pages.matches', $this->data);
    }
}
