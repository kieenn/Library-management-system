<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TraSach extends Model
{
    protected $table = 'tra_sach';
    protected $primaryKey = 'ReturnID';
    public $timestamps = false;

    protected $fillable = [
        'id_doc_gia',
        'ngay_tra',
        'ma_sach',
        'ngay_muon',
        'so_ngay_muon',
        'tien_phat',
        'tong_no',
    ];

    // Relationship with DocGia (Readers)
    public function docGia()
    {
        return $this->belongsTo(DocGia::class, 'id_doc_gia', 'ID');
    }

    // Relationship with Sach (Books)
    public function sach()
    {
        return $this->belongsTo(Sach::class, 'ma_sach', 'ID');
    }
}
