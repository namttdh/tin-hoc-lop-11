<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class ProjectDone extends Model
{
    protected $table = 'project_done';
    protected $fillable = ['id_user','id_project'];

}
