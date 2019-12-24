<?php


namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Projects extends Model
{
    protected $table = 'projects';
    protected $fillable = ['name', 'id_syllabus', 'description', 'type', 'json_data', 'id_group_syllabus'];

    public static function findById($id)
    {
        return self::query()->where("id", $id)->first();
    }

    public static function findByName($name)
    {
        $project = DB::table('projects')
            ->join('syllabus', 'projects.id_syllabus', '=', 'syllabus.id')
            ->select('projects.id', 'projects.name', 'syllabus.name as syllabus_name', 'projects.description', 'projects.json_data')
            ->where('projects.name', 'like', '%'.$name.'%')
            ->get();
        // $project = self::query()->where("name", "like", "%" . $name . "%")->get();
        return $project;
    }

    public static function getAll()
    {
        $project = self::query()->get();
        $project = DB::table('projects')
            ->join('syllabus', 'projects.id_syllabus', '=', 'syllabus.id')
            ->select('projects.*', 'syllabus.name as syllabus_name')
            ->get();
        return $project;
    }
    
    public static function deleteByIdSyllabus($id_syllabus)
    {
        $project = DB::table('projects')->where('id_syllabus', '=', $id_syllabus)->delete();
        return $project;
    }

    public static function deleteByIdSyllabusGroup($id_group_syllabus)
    {
        $project = DB::table('projects')->where('id_group_syllabus', '=', $id_group_syllabus)->delete();
        return $project;
    }

    public static function getListProject($name)
    {
        $project = DB::table('syllabus')
            ->join('projects', 'syllabus.id', '=', 'projects.id_syllabus')
            ->select('projects.id as id_project', 'projects.name', 'syllabus.name as name_syllabus')
            ->where('syllabus.name', 'like', '%'.$name.'%')
            ->get();
        return $project;
    }
}
