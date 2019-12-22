<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        // $syllabus = self::query()->where("name", "like", "%".$name."%")->get();
        $syllabus = DB::table('syllabus')
        ->join('group_syllabus', 'syllabus.id_group', '=', 'group_syllabus.id')
        ->select('syllabus.id','syllabus.name', 'group_syllabus.name as group_name')
        ->where('syllabus.name', 'like', '%'.$name.'%')
        ->get();
        return $syllabus;
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
