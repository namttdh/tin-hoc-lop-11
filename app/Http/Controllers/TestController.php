<?php

namespace App\Http\Controllers;

use App\Http\Model\GroupSyllabus;
use App\Http\Model\Syllabus;
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

    public function test(){

        $project = DB::table('projects')->get('id_syllabus');
        foreach ($project as $v)
        {
            param($v);
        }
        
    }


    public function testAuth(Request $request){
        return $request->user();
    }
}
