<?php

namespace App\Models;

use App\Models\User;
use App\Models\Collage;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Code extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = ['uuid','value','user_id','collage_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function collage(){
        return $this->belongsTo(Collage::class);
    }
}
