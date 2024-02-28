<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'date'=> "date:d/m/Y",
        'check_in',
        'check_out',
        'break',
        'description',
    ];

    protected $table = 'attendances';

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
