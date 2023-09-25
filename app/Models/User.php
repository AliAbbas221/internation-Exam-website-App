<?php

namespace App\Models;

use App\Models\Code;
use App\Models\Question;
use App\Models\Traits\HasUuid;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuid, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'user_name',
        'phone',
        'role',
        'image',
        'fcm_token'
    ];

    protected $hidden = [
        'remember_token',
    ];
    public function codes()
    {
        return $this->hasMany(Code::class);
    }
    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites', 'user_id', 'question_id');
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    function hasAccessToCollage($collage_id)
    {
        return Auth::user()->tokenCan('collage_id:' . $collage_id);
    }
}