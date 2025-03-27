<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPenjualan extends Model
{
    use HasFactory;
 
    protected $table = 'table_item_penjualan';
    protected $primaryKey = 'nota';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = ['nota', 'kode_barang', 'qty'];
    public $timestamps = false;

    
}
