<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['subMenus'];

    public function subMenus()
    {
        return $this->hasMany(Menu::class, 'main_menu');
    }
}
