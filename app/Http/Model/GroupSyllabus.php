<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class GroupSyllabus extends Model
{
    protected $table = "group_syllabus";
    protected $fillable = ['name'];

    public static  function  findById($id)
    {
        return self::query()->where("id", $id)->first();
    }

    public static function getAll()
    {
        return self::query()->get();
    }

    public static function getLimit()
    {
        return self::query()->paginate(10);
    }

    public static function findByName($name)
    {
        return self::query()->where("name", "like", "%".$name."%")->get();
    }
}