<?php

namespace App\Models;

use App\Models\Code;
use App\Models\Term;
use App\Models\Question;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Collage extends Model
{
    use HasFactory, HasUuid;
    protected $fillable = ['uuid','collage_name','category_id','image'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function specializations(){
        return $this->hasMany(Specialization::class);
    }
    public function codes(){
        return $this->hasMany(Code::class);
    }
    public function questions(){
        return $this->hasMany(Question::class);
    }
    public function terms(){
        return $this->hasMany(Term::class);
    }
}
