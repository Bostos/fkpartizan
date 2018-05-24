<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class MenuController extends Controller{
  
    public function index(){
        $this->data['menus'] = Menu::all();
        return view('admin.pages.menus', $this->data);
    }

    public function create(){
        $this->data['menus'] = Menu::whereNull('parent_id')->get();
        return view ('admin.pages.create_menu', $this->data);
    }

    public function store(Request $request){
        $menu = new Menu();
        $menu->name = $request->naziv;
        $menu->path = $request->putanja;
        $menu->position = $request->pozicija;
        if($request->roditelj != ''){
            $menu->parent_id = $request->roditelj;
        }
        $menu->has_children = $request->podmeni;

        $request->validate([
            'naziv' => 'required',
            'putanja' => 'required',
            'pozicija' => 'required'
        ]);

        try{
            $menu->save();
            \Log::info('Dodat je meni: "'. $menu->name.'"');
            if($request->roditelj!=''){
                $alterMenu = Menu::find($request->roditelj);
                $alterMenu->has_children = 1;
                $alterMenu->save();
                \Log::info('Izmenjen je meni: "'. $alterMenu->name.'". Dodad je njegov podmeni: "'.$menu->name.'"');
            }
            return back()->with('success', 'Dodat je novi meni: "'. $menu->name.'"');
        }catch(\Exception $e){
            \Log::error('Greškla prilikom dodavanja menija. '.$e);
            return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        //
    }
}
