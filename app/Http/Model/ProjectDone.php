<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectDone extends Model
{
    protected $table = 'project_done';
    protected $fillable = ['id_user','id_project', 'id_syllabus'];
    
    public static function findById($id){
        return self::query()->where("id", $id)->first();
    }
    
    public static function getAll(){
        return self::query()->get();
    }

    public static function getidProjectsByIdUser($id_user)
    {
        return self::query()->where("id", $id_user)->first();
    }

    public static function countProjectDoneByIdUser($id_user, $id_syllabus)
    {
        $count = DB::table('project_done')
            ->where(
                [
                    ['id_user', '=', $id_user],
                    ['id_syllabus', '=', $id_syllabus]
                ])
            ->count();
        return $count;
    }

}
