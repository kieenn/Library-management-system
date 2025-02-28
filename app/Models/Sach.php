<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sach extends Model
{
    protected $table = 'sach';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'ten_sach',
        'the_loai',
        'tac_gia',
        'nam_xuat_ban',
        'nha_xuat_ban',
        'ngay_nhap',
        'gia',
    ];

    // Relationship with MuonSach (Book Loans)
    public function muonSach()
    {
        return $this->hasMany(MuonSach::class, 'ma_sach', 'ID');
    }

    // Relationship with TraSach (Book Returns)
    public function traSach()
    {
        return $this->hasMany(TraSach::class, 'ma_sach', 'ID');
    }
}
