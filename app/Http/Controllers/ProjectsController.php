<?php

namespace App\Http\Controllers;

use App\Http\Model\Projects;
use App\Http\Model\Syllabus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectsController extends Controller
{
    public function create(Request $request){
        $project = new Projects();
        $project->name = $request->name;
        $project->id_syllabus = $request->id_syllabus;
        $project->description = $request->description;
        $project->type = $request->type;
        $project->json_data = $request->json_data;       
        $project->id_group_syllabus = Syllabus::getIdGroup($request->id_syllabus)->id_group;
        $project->save();
        return $project;
    }

    public function edit(Request $request){
        $project = Projects::findById($request->id);
        $project->name = $request->name;
        $project->id_syllabus = $request->id_syllabus;
        $project->description = $request->description;
        $project->type = $request->type;
        $project->json_data = $request->json_data;
        $project->id_group_syllabus = $request->id_group_syllabus;
        $project->save();
        return $project;
    }

    public function delete(Request $request){
        $project = Projects::findById($request->id);
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
    
    public function getListProject(Request $request){
        $project = Projects::getListProject($request->name);
        return $project;
    }
    

}