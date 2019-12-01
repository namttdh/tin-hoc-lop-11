<?php

namespace App\Http\Controllers;

use App\Http\Model\ProjectDone;
use Illuminate\Http\Request;

class ProjectDoneController extends Controller
{
    public function create(Request $request){
        $project = new ProjectDone();
        $project->id_user = $request->id_user;
        $project->id_project = $request->id_project;
        $project->save();
        return $project;
    }

    public function edit(Request $request,$id){
        $project = ProjectDone::findById($id);
        $project->id_user = $request->id_user;
        $project->id_project = $request->id_project;
        $project->save();us;
        $project->save();
        return $project;
    }

    public function delete($id){
        $project = ProjectDone::findById($id);
        $project->delete();
        return $project;
    }
    
    public function getAll(){
        $project = ProjectDone::getAll();
        return $project;
    }

}