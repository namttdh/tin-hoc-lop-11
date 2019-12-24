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
            ->select('syllabus.id', 'syllabus.name', 'group_syllabus.name as group_name')
            ->where('syllabus.name', 'like', '%'.$name.'%')
            ->get();
        return $syllabus;
    }

    public static function getAll()
    {
        $syllabus =  self::query()->get();
        $syllabus = DB::table('syllabus')
            ->join('group_syllabus', 'syllabus.id_group', '=', 'group_syllabus.id')
            ->select('syllabus.id', 'syllabus.name', 'syllabus.id_group', 'group_syllabus.name as group_name')
            ->get();
        return $syllabus;
    }

    public static function getPaginateGroupSyllabus()
    {
        $syllabus = DB::table('syllabus')
            ->join('group_syllabus', 'syllabus.id_group', '=', 'group_syllabus.id')
            ->select('syllabus.id', 'syllabus.name', 'syllabus.id_group', 'group_syllabus.name as group_name')
            ->paginate(10);
        return $syllabus;
    }

    public static function getPaginateSyllabus()
    {
        $syllabus = DB::table('syllabus')
            ->join('projects', 'syllabus.id', '=', 'projects.id_syllabus')
            ->select('syllabus.id', 'syllabus.name', 'syllabus.id_group', 'projects.name as project_name')
            ->paginate(10);
        return $syllabus;
    }

    public static function getOject()
    {
        return self::query()->get("syllabus.name", "syllabus.id_group");
    }

    public static function deleteByidGroup($id_group)
    {
        $syllabus = DB::table('syllabus')->where('id_group', '=', $id_group)->delete();
        return $syllabus;
    }

    
    public static function getListSyllsbus()
    {
        $syllabus = DB::table('group_syllabus')
            ->join('syllabus', 'syllabus.id_group', '=', 'group_syllabus.id')
            ->select('group_syllabus.id as id_group_syllabus', 'group_syllabus.name as name_group_syllabus', 'syllabus.name as syllabus_name', 'syllabus.id')
            ->get();
        return $syllabus;
    }
    
    public static function getIdGroup($id)
    {
        return self::query()->where("id", $id)->first();
    }
    
    public static function getIdByIdGroup($id_group)
    {
        return self::query()->where("id_group", $id_group)->get('id');
    }

    public static function countAllSyllabus()
    {
        $count = DB::table('syllabus')
        ->count();
    return $count;
    }

}
