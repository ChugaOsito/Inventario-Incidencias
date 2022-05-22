<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $table = 'project_user';

    public function project()
    {
    	return $this->belongsTo('App\Project');
    }

    public function level()
    {
    	return $this->belongsTo('App\Level');
    }
}
