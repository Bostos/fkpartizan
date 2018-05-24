<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model{
    protected $table = 'navigation';

    public function parent() {
    	return $this->hasOne('App\Menu', 'id', 'parent_id');
    }

    public function children() {
		return $this->hasMany('App\Menu', 'parent_id', 'id');
    }  

    public static function tree() {
		return static::with(implode('.', array_fill(0, 4, 'children')))->where('parent_id', '=', NULL)->get();
    }
}
