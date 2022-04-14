<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $table = 'rests';

    protected $fillable = ['attendance_id', 'start_time', 'end_time'];


    public function get_rest_time()
    {
        $breakeEndTime = strtotime($this->end_time);
        $breakeStartTime = strtotime($this->start_time);
        $diff = $breakeEndTime - $breakeStartTime;
        
        return $diff;
        
    }
}