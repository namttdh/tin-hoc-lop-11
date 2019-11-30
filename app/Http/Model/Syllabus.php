<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    protected $table = "syllabus";
    protected $fillable = ['name','sub_name','id_group'];
}
