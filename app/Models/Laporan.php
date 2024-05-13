<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $fillable = ['nik', 'nama_pelapor', 'jurusan', 'no_hp', 'tanggal_kejadian', 'tempat_kejadian', 'nama_korban', 'nama_pelaku', 'deskripsi_kejadian', 'bukti_photo'];
}
