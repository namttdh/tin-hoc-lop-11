<?php

namespace App\Http\Controllers;

use App\Http\Model\Syllabus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SyllabusController extends Controller
{
    public function create(Request $request)
    {
        $syllabus = new Syllabus();
        $syllabus->name = $request->name;
        // $syllabus->sub_name = $request->sub_name;
        $syllabus->id_group = $request->id_group;
        $syllabus->save();
        return $syllabus;
    }

    public function edit(Request $request)
    {
        $syllabus = Syllabus::findById($request->id);
        $syllabus->name = $request->name;
        // $syllabus->sub_name = $request->sub_name;
        $syllabus->id_group = $request->id_group;
        $syllabus->save();
        return $syllabus;
    }

    public function delete(Request $request)
    {
        $syllabus = Syllabus::findById($request->id);
        $syllabus->delete();
        return $syllabus;
    }

    public function getAll()
    {
        $syllabus = Syllabus::getAll();
        $syllabus = DB::table('syllabus')
            ->join('group_syllabus', 'syllabus.id_group', '=', 'group_syllabus.id')
            ->select('syllabus.id','syllabus.name','syllabus.id_group', 'group_syllabus.name as group_name')
            ->get();
        return $syllabus;
    }

    public function getPaginateGroupSyllabus()
    {
        $object = DB::table('syllabus')
            ->join('group_syllabus', 'syllabus.id_group', '=', 'group_syllabus.id')
            ->select('syllabus.id','syllabus.name','syllabus.id_group', 'group_syllabus.name as group_name')
            // ->get();
        ->paginate(10);
        return $object;
    }

    public function getPaginateProjects()
    {
        $object = DB::table('syllabus')
            ->join('projects', 'syllabus.id', '=', 'projects.id_syllabus')
            ->select('syllabus.id','syllabus.name','syllabus.id_group', 'projects.name as project_name')
            // ->get();
            ->paginate(10);
        return $object;
    }

    public function findByName(Request $request)
    {
        $syllabus = Syllabus::findByName($request->name);
        $syllabus = DB::table('syllabus')
            ->join('group_syllabus', 'syllabus.id_group', '=', 'group_syllabus.id')
            ->select('syllabus.id','syllabus.name', 'group_syllabus.name as group_name')
            ->get();
        return $syllabus;
    }

    public function test()
    {
        $syllabus = Syllabus::getOject();
        return $syllabus;
    }
}
