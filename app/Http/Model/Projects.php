<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';
    protected $fillable = ['name', 'id_syllabus', 'description', 'type', 'json_data'];

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
}
