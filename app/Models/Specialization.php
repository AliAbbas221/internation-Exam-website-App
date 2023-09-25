<?php

namespace App\Models;

use App\Models\Collage;
use App\Models\Question;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specialization extends Model
{
    use HasFactory, HasUuid;
    protected $fillable = ['uuid','specialization_name','collage_id'];

    public function collage(){
        return $this->belongsTo(Collage::class);
    }
    public function questions(){
        return $this->hasMany(Question::class);
    }

}
