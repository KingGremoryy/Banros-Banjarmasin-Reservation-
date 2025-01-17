<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory;
    
    protected $fillable = ['lapangan', 'image', 'detail', 'harga'];

    protected $table = 'lapangan';

}
