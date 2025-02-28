<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MuonSach extends Model
{
    protected $table = 'muon_sach';
    protected $primaryKey = 'LoanID';
    public $timestamps = false;

    protected $fillable = [
        'id_doc_gia',
        'ngay_muon',
        'ma_sach',
        'ten_sach',
        'the_loai',
        'tac_gia',
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
