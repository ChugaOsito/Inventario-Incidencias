<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Project;
use App\Level;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

       // relationships

       public function projects()
       {
           return $this->belongsToMany('App\Project');
       }

       public function canTake(Incident $incident)
       {
           return ProjectUser::where('user_id', $this->id)
                           ->where('level_id', $incident->level_id)
                           ->first();
       }
   
       // accessors
       public function getAvatarPathAttribute()
       {
           if ($this->is_client)
               return '/images/client.png';
   
           return '/images/support.png';
       }
   
       public function getListOfProjectsAttribute()
       {
           if ($this->role == 1)
               return $this->projects;
   
           return Project::all();
           return $this->belongsToMany(Role::class, 'role_user_table', 'user_id', 'role_id');
       }
   
       public function getIsAdminAttribute()
       {
           return $this->role == 0;
       }
       public function getIsSupportAttribute()
       {
           return $this->role == 1;
       }
       public function getIsClientAttribute()
       {
           return $this->role == 2;   
       }
       public function incidents()
       {
           return $this->hasMany('App\Models\Incident', 'client_id', 'id', 'producto_id');
       }
       
   }
   