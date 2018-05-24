<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table;

class TableController extends Controller{

    public function index(){
        $table = Table::all();
        $this->data['tables'] = $table;
        return view('admin.pages.tables', $this->data);
    }

    public function create(){
        return view('admin.pages.create_table');
    }

    public function store(Request $request){
        $table = new Table();
        $table->name = $request->naslov;
        $table->season = $request->sezona;
        $playoff = $request->playoff;
        if($playoff==''){
            $table->is_playoff=0;
        }
        else{
            $table->is_playoff=1;
        }

        $request->validate([
            'naslov' => 'required',
            'sezona' => 'required'
        ]);

        if($playoff!=''){
            try{
                \Schema::create($table->name, function($table){
                    $table->increments('id');
                    $table->string('club');
                    $table->integer('matches')->default(0);
                    $table->integer('wins')->default(0);
                    $table->integer('draws')->default(0);
                    $table->integer('defeats')->default(0);
                    $table->integer('goals_for')->default(0);
                    $table->integer('goals_against')->default(0);
                    $table->integer('points')->default(0);
                    $table->integer('points_taken')->default(0);
                });
                $table->save();
                \Log::info('Dodata je tabela: "'.$table->name.' ('.$table->season.')"');
                return back()->with('success', 'Dodata je tabela: '.$table->name.' ('.$table->season.')');
            }
            catch(\Exception $e){
                \Log::error('Greškla prilikom dodavanja tabele. '.$e);
                return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
            }
        }
        else{
            try{
                \Schema::create($table->name, function($table){
                    $table->increments('id');
                    $table->string('club');
                    $table->integer('matches')->default(0);
                    $table->integer('wins')->default(0);
                    $table->integer('draws')->default(0);
                    $table->integer('defeats')->default(0);
                    $table->integer('goals_for')->default(0);
                    $table->integer('goals_against')->default(0);
                    $table->integer('points')->default(0);
                });
                $table->save();
                \Log::info('Dodata je tabela: "'.$table->name.' ('.$table->season.')"');
                return back()->with('success', 'Dodata je tabela: '.$table->name.' ('.$table->season.')');
            }
            catch(\Exception $e){
                \Log::error('Greškla prilikom dodavanja tabele. '.$e);
                return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
            }
        }
    }

    public function edit($id){
        $table = Table::find($id);
        $table_name = $table->name;
        $table_id = $table->id;
        $data = \DB::table($table_name)->orderBy('points', 'desc')->get();
        $this->data['table'] = $data;
        $this->data['id'] = $table_id;
        return view('admin.pages.edit_table', $this->data);
    }

    public function update(Request $request, $id){
        $table = Table::find($id);
        $table_name = $table->name;

        $club = $request->club;
        $wins = $request->wins;
        $draws = $request->draws;
        $defeats = $request->defeats;
        $goals_for = $request->goals_for;
        $goals_against = $request->goals_against;
        $matches = $wins+$draws+$defeats;
        $current_table = \DB::table($table_name)->where('club', $club)->get()->first();
        if($table->is_playoff == 1){
            $points_taken = $request->points_taken;
            $points = ($wins*3)+($draws*1)-($current_table->points_taken);
        }
        else{
           $points = ($wins*3)+($draws*1); 
        }

        try{
            if($table->is_playoff == 1){
                \DB::table($table_name)->where('club', $club)
                                    ->update([
                                        'matches' => $matches,
                                        'wins' => $wins,
                                        'draws' => $draws,
                                        'defeats' => $defeats,
                                        'goals_for' => $goals_for,
                                        'goals_against' => $goals_against,
                                        'points' => $points,
                                        'points_taken' => $points_taken
                                    ]);
            }
            else{
                \DB::table($table_name)->where('club', $club)
                                    ->update([
                                        'matches' => $matches,
                                        'wins' => $wins,
                                        'draws' => $draws,
                                        'defeats' => $defeats,
                                        'goals_for' => $goals_for,
                                        'goals_against' => $goals_against,
                                        'points' => $points
                                    ]);
            }
            \Log::info('Ažurirana je tabela: "'.$table_name.')"');
            return back()->with('success', 'Tabela ažurirana.');
        }
        catch(\Exception $e){
            \Log::error('Greškla prilikom izmene tabele. '.$e);
            return redirect('admin/tables')->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }

    public function destroy($id){
        //
    }

    public function create_fill($id){
        $this->data['table'] = Table::find($id);
        $this->data['clubs'] = \App\Club::all();
        return view('admin.pages.fill_table', $this->data);
    }

    public function store_fill(Request $request, $id){
        $table = Table::find($id);
        $table_name = $table->name;
        $club_id = $request->klub;
        $club = \App\Club::find($club_id);
        $request->validate(['klub' => 'required']);

        try{
            \DB::table($table_name)->insert(['club' => $club->name]);
            \Log::info('Dodat je klub: '.$club->name);
            return back()->with('success', 'Dodat je klub: '.$club->name);
        }
        catch(\Exception $e){
            \Log::error('Greškla prilikom dodavanja kluba u tabelu. '.$e);
            return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }
}
