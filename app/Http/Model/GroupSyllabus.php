<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class GroupSyllabus extends Model
{
    protected $table = "group_syllabus";
    protected $fillable = ['name'];

    public static  function  findById($id){
        return self::query()->where("id",$id)->first();
    }
    public static function getAll(){
        return self::query()->get();
    }

}
