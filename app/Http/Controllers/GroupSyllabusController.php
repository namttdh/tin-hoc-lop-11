<?php

namespace App\Http\Controllers;

use App\Http\Model\GroupSyllabus;
use Illuminate\Http\Request;

class GroupSyllabusController extends Controller
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

    public function delete($id){
        $groupSyllabus = GroupSyllabus::findById($id);
        $groupSyllabus->delete();
        return $groupSyllabus;
    }
    
    public function getAll(){
        $groupSyllabus = GroupSyllabus::getAll();
        return $groupSyllabus;
    }

    public function getPaginate()
    {
        $groupSyllabus = GroupSyllabus::getLimit();
        return $groupSyllabus;
    }

    public function test(){
        echo"asjhd";
        return 0;
    }

}