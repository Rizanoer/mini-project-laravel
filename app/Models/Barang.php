<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
 
    protected $table = 'table_barang';
    protected $primaryKey = 'kode';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = ['kode', 'nama', 'kategori', 'harga'];
    public $timestamps = false;

    
}
