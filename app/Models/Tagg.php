<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Kit;

class Tagg extends Model{
    use HasFactory;

    protected $fillable = [
        'title',
        'post',
        'created_by',
        'tagg_id'
    ];
    public function kits(){
        return $this->belongsToMany(Kit::class);
    }
}