<?php

namespace App\Models;

use App\Models\Ruangan;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = ['id_user'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'ruangans' => 'array,'
    ];

    // protected $with = ['ruangan','notifikasi','order'];

    function data ($value) { ["user", "admin", "manager"][$value]; }
    protected function type(): Attribute
    {
        return new Attribute(
            get: fn($value) => ["user","admin"],
        );
    }
    public function ruangan(){
       return $this->belongsToMany(Ruangan::class, 'ruangans_users');
    }
    public function order(){
       return $this->hasMany(Order::class);
    }    
    public function notifikasi(){
       return $this->belongsToMany(Notifikasi::class,'notif_users');
    }
    public static function adminId(){
        return User::where('cekLevel','admin')->get()->pluck('id');
    }
}
