<?php

namespace App\Models;

use App\Models\Collage;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Term extends Model
{
    use HasFactory, HasUuid;
    protected $fillable=['uuid','term_name','type', 'collage_id'];
    public function collage()
    {
        return $this->belongsTo(Collage::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
