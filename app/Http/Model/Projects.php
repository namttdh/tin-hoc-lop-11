<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';
    protected $fillable = ['name','id_syllabus','description','type','json_data'];

}
