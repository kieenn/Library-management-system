<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocGia extends Model
{
    protected $table = 'doc_gia';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = [
        'ho_va_ten',
        'loai_doc_gia',
        'ngay_sinh',
        'dia_chi',
        'email',
        'ngay_lap_the',
        'token',
    ];

    // Example: app/Models/MuonSach.php
// ... other properties ...

    public function sach()
    {
        return $this->belongsTo(Sach::class, 'ma_sach', 'id');
    }

    public function docGia()
    {
        return $this->belongsTo(DocGia::class, 'id_doc_gia', 'id');
    }
}
