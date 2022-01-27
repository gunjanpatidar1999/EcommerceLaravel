<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    use HasFactory;
    protected $table = 'banners';
    
    public function bannerimage()
    {
        return $this->hasMany(bannerimage::class);
    }
}
