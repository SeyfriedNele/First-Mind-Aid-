<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tagg;
use App\Models\User;

class Kit extends Model{
    use HasFactory;

    protected $fillable = [
        'title',
        'post',
        'created_by',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function createdby()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function tagg(){
        return $this->belongsToMany(Tagg::class);
    }
}