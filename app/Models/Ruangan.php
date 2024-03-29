<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $attributes = ['status' => 'aktif'];
    // protected $with = ['user'];
    public function user(){
       return $this->belongsToMany(User::class, 'ruangans_users');
    }
    
}
