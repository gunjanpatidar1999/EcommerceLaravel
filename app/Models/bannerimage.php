<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bannerimage extends Model
{
    use HasFactory;
    protected $table = 'bannerimages';

    public function banner()
    {
       return $this->belongsTo(banner::class);
    }
}
