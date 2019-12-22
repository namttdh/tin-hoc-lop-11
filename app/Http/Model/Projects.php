<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return self::query()->get();
    }
}
