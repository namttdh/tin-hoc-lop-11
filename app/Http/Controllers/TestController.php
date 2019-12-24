<?php

namespace App\Http\Controllers;

use App\Http\Model\GroupSyllabus;
use App\Http\Model\ProjectDone;
use App\Http\Model\Syllabus;
use App\Http\Model\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    public function create(Request $request){
        $groupSyllabus = new GroupSyllabus();
        $groupSyllabus->name = $request->name;
        $groupSyllabus->save();
        return $groupSyllabus;
    }

    public function edit(Request $request,$id){
        $groupSyllabus = GroupSyllabus::findById($id);
        $groupSyllabus->name = $request->name;
        $groupSyllabus->save();
        return $groupSyllabus;
    }

    public function test(Request $request){
        $s = Projects::countAllProjects();
        // $countProjects = Projects::countProjectBySyllabusId($idSyllabus);
        // $s = ProjectDone::getidProjectsByIdUser($request->id);
        // $countProjectDone = ProjectDone::countProjectDoneByIdUser($request->id, 16);
        // $percent = (($countProjectDone / $countProjects));
        // return $countProjectDone;
        return $s;
        

        

    }


    public function testAuth(Request $request){
        return $request->user();
    }
}
