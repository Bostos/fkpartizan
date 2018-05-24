<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller{

    public function index(){
        $this->data['news'] = News::orderBy('date', 'desc')->get();
        return view('admin.pages.news', $this->data);
    }

    public function create(){
        return view('admin.pages.create_news');
    }

    public function store(Request $request){
        $news = new News();
        $news->title = $request->naslov;
        $news->cover_image = $request->slika;
        $news->body = $request->editordata;
        $news->source = $request->izvor;
        $news->date = $request->datum;
        $news->user_id = 1; //Izmeni kasnije

        $request->validate([
            'naslov' => 'required|max:200',
            'editordata' => 'required',
            'izvor' => 'required|max:200',
            'datum' => 'required',
            'slika' => 'required'
        ]);

        try{
            $news->save();
            \Log::info('Objavljena je vest: '.$news->title.'.');
            return back()->with('success', 'Vest je objavljena.'); 
        }catch(Exception $e){
            \Log::error('Greškla prilikom dodavanja vesti. '.$e);
            return back()->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }

    public function show($id){
        $news = News::find($id);
        $this->data['news'] = $news;
        $this->data['nav'] = \App\Menu::tree();
        return view('pages.single_news', $this->data);
    }
    
    public function edit($id){
        $news = News::find($id);
        $this->data['news'] = $news;
        return view('admin.pages.edit_news', $this->data);
    }

    public function update(Request $request, $id){
        $news = News::find($id);
        $news->title = $request->naslov;
        $news->cover_image = $request->slika;
        $news->body = $request->editordata;

        $request->validate([
            'naslov' => 'required|max:200',
            'editordata' => 'required',
            'slika' => 'required'
        ]);

        try{
            $news->save();
            \Log::info('Izmenjena je vest: '.$news->title.'.');
            return redirect('admin/news')->with('success', 'Vest je izmenjena.'); 
        }catch(Exception $e){
            \Log::error('Greškla prilikom izmene vesti. '.$e);
            return redirect('admin/news')->with('error', 'Došlo je do greške, pokušajte kasnije.');
        }
    }

    public function destroy($id){
        //
    }
}
