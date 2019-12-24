<?php

namespace App\Http\Controllers;

use App\Http\Model\GroupSyllabus;
use App\Http\Model\Syllabus;
use App\Http\Model\Projects;
use Illuminate\Http\Request;

class GroupSyllabusController extends Controller
{
    public function create(Request $request){
        $groupSyllabus = new GroupSyllabus();
        $groupSyllabus->name = $request->name;
        $groupSyllabus->name = $request->name;
        $groupSyllabus->save();
        return $groupSyllabus;
    }

    public function edit(Request $request){
        $groupSyllabus = GroupSyllabus::findById($request->id);     
        $groupSyllabus->name = $request->name;
        $groupSyllabus->save();
        return $groupSyllabus;
    }

    public function delete(Request $request){
        $project = Projects::deleteByIdSyllabusGroup($request->id);
        $syllabus = Syllabus::deleteByidGroup($request->id);
        $groupSyllabus = GroupSyllabus::findById($request->id);
        $groupSyllabus->delete();
        return $groupSyllabus;
    }

    public function getAll(){
        $groupSyllabus = GroupSyllabus::getAll();
        return $groupSyllabus;
    }

    public function getPaginate()
    {
        $groupSyllabus = GroupSyllabus::getPaginate(10);
        return $groupSyllabus;
    }

    public function findByName(Request $request)
    {
        $groupSyllabus = GroupSyllabus::findByName($request->name);
        // $groupSyllabus->name = $request->name;
        return $groupSyllabus;
    }

    public function test(){
        echo"asjhd";
        return 0;
    }

}
