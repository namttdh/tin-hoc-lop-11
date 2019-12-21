<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    protected $table = "syllabus";
    protected $fillable = ['name', 'sub_name', 'id_group'];

    public static function findById($id)
    {
        return self::query()->where("id", $id)->first();
    }

    public static function findByName($name)
    {
        return self::query()->where("name", "like", "%".$name."%")->get();
    }

    public static function getAll()
    {
        return self::query()->get();
    }

    public static function getOject()
    {
        return self::query()->get("syllabus.name", "syllabus.id_group");
    }
}
