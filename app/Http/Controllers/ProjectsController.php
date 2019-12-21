<?php

namespace App\Http\Controllers;

use App\Http\Model\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function create(Request $request){
        $project = new Projects();
        $project->name = $request->name;
        $project->id_syllabus = $request->id_syllabus;
        $project->description = $request->description;
        $project->type = $request->type;
        $project->json_data = $request->json_data;
        $project->save();
        return $project;
    }

    public function edit(Request $request,$id){
        $project = Projects::findById($id);
        $project->name = $request->name;
        $project->id_syllabus = $request->id_syllabus;
        $project->description = $request->description;
        $project->type = $request->type;
        $project->json_data = $request->json_data;
        $project->save();
        return $project;
    }

    public function delete($id){
        $project = Projects::findById($id);
        $project->delete();
        return $project;
    }
    
    public function findByName(Request $request)
    {
        $project = Projects::findByName($request->name);
        return $project;
    }
    
    public function getAll(){
        $project = Projects::getAll();
        return $project;
    }

}