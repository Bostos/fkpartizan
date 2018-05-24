<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller{

	public function __construct(){
		$this->data['nav'] = \App\Menu::tree();
	}

	public function index(){
        $match = new \App\Match();
		$last_match = $match->last_match();
        $next_match = $match->next_match();

        $slider_news = \App\News::orderBy('date', 'desc')->limit(4)->get();
		$this->data['last_match'] = $last_match;
		$this->data['next_match'] = $next_match;
		$this->data['slider_news'] = $slider_news;
		return view ('pages.home', $this->data);
	}

    public function admin(){
        $goals = new \App\Goal();
        $this->data['total_goals'] = $goals->count();
    	return view('admin.pages.dashboard', $this->data);
    }

    public function news(){
    	$this->data['news'] = \App\News::orderBy('date', 'desc')->get();
    	return view('pages.news', $this->data);
    }

    public function team(){
        $player = new \App\Player();
        $this->data['goalkeepers'] = $player->get_goalkeepers();
        $this->data['defenders'] = $player->get_defenders();
        $this->data['midfielders'] = $player->get_midfielders();
    	$this->data['attackers'] = $player->get_attackers();
    	return view('pages.team', $this->data);
    }

    public function matches(){
        $match = new \App\Match();
        $this->data['superliga'] = $match->get_competition_matches(1);
        /*$this->data['kup'] = $match->get_competition_matches(2);*/
        $this->data['kup'] = \App\Match::select('*', \DB::raw("month(date) as month"))->where('competition_id', '2')->groupBy(\DB::raw("month(date)"))->orderBy('date', 'desc')->get();
        $this->data['ligaevrope'] = $match->get_competition_matches(3);
        $this->data['ligasampiona'] = $match->get_competition_matches(4);
        /*$this->data['prijateljske'] = $match->get_competition_matches(5);*/
        $this->data['pr_meseci'] = \App\Match::select(\DB::raw("month(date) as month"))->where('competition_id', '5')->groupBy(\DB::raw("month(date)"))->orderBy('date', 'desc')->get();
        $this->data['prijateljske'] = \App\Match::select('*', \DB::raw("month(date) as month"), \DB::raw('count(*) as total'))->where('competition_id', '5')->groupBy(\DB::raw("month(date)"))->orderBy('date', 'desc')->get();
        return view('pages.matches', $this->data);
    }

    public function competitions(){
        $season = new \App\Season();
        $this->data['season'] = $season->get_current_season();
        $this->data['competitions'] = \App\Competition::select('competitions.*', 'photos.path')->join('photos', 'competitions.logo_id', '=', 'photos.id')->get();
        return view('pages.competitions', $this->data);
    }

    public function single_competition($id, Request $request){
        $season = new \App\Season();
        $goals = new \App\Goal();
        $current_season = $season->get_current_season();
        /*$season_id = $request->sezona;
        $current_season = \App\Season::find($season_id);*/

        $this->data['seasons'] = $season::orderBy('year', 'desc')->get();
        $this->data['current_season'] = $current_season;
        if($id==1){
            $table = \App\Table::select('name')->where('competition_id', $id)->where('season', $current_season->year)->get()->first();
            $this->data['clubs'] = \DB::table($table->name)->orderBy('points', 'desc')->get();
            $playoff_table = \App\Table::select('name')->where('competition_id', $id)->where('season', $current_season->year)->get();
            $this->data['playoff'] = \DB::table($playoff_table[1]->name)->orderBy('points', 'desc')->get();
        }
        if($id==2){
            $this->data['cup_matches'] = \App\Match::where('competition_id', $id)->where('season_id', $current_season->id)->orderBy('date', 'asc')->get();
        }
        if($id==3){
            $this->data['el_matches'] = \App\Match::where('competition_id', $id)->where('season_id', $current_season->id)->orderBy('date', 'asc')->get();
            $table = \App\Table::select('name')->where('competition_id', $id)->where('season', $current_season->year)->get();
            $this->data['europa_league'] = \DB::table($table[0]->name)->get();
        }
        if($id==4){
            $this->data['cl_matches'] = \App\Match::where('competition_id', $id)->where('season_id', $current_season->id)->orderBy('date', 'asc')->get();
        }
        $this->data['goalscorers'] = $goals->goalscorers($id);
        return view('pages.single_competition', $this->data);
    }

    public function vesnik(){

    }

    public function login(){
        return view('pages.login');
    }

    public function register(){

    }
    
}
