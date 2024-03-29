<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['user'];
    public function user()
    {
        return $this->belongsToMany(User::class,'notif_users');
    }
    protected $attributes = [
        'mark' => 'false',
        // 'msg_pesan' => 'pesanan anda sudah di terima oleh admin harap ambil di ruang admin'
    ];
    

    public static function notif($tb, $msg, $jn, $st, )
    {
        return [
                'nama_table' => $tb,
                'msg' => $msg,
                'jenis_notifikasi' => $jn,
                'status' => $st
        ];
    }
}
