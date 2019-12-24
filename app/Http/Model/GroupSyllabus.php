<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getPaginate($page)
    {
        return self::query()->paginate($page);
    }

    public static function findByName($name)
    {
        return self::query()->where("name", "like", "%".$name."%")->get();
    }

}
