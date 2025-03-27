<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
 
    protected $table = 'table_penjualan';
    protected $primaryKey = 'id_nota';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = ['id_nota', 'tgl', 'kode_pelanggan', 'subtotal'];
    public $timestamps = false;

    
}
