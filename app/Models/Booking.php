<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'telepon',
        'res_date',
        'res_time',
        'arena_id',
        'tamu',
    ]; 


    protected $table = 'booking';
    
    protected $dates = [
        'res_date'
    ];

    public function Arena()
    {
        return $this->belongsTo(Arena::class);
    }

}
