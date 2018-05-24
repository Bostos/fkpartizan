<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model{
    protected $table = 'seasons';

    public function get_current_season(){
    	return \DB::table($this->table)
    				->orderBy('year', 'desc')
    				->get()
    				->first();
    }
}
