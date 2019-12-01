<?php

namespace App\Http\Controllers;

use App\Http\Model\GroupSyllabus;
use Illuminate\Http\Request;

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

    public function test($id){
        return GroupSyllabus::findById($id);
    }



    public function testAuth(Request $request){
        return $request->user();
    }
}
