<?php

namespace App\Http\Controllers;

use App\Http\Model\ProjectDone;
use App\Http\Model\Projects;
use Illuminate\Http\Request;

class ProjectDoneController extends Controller
{
    public function create(Request $request){
        $project = new ProjectDone();
        $project->id_user = $request->id_user;
        $project->id_project = $request->id_project;
        $project->id_syllabus = Projects::getIdSyllabusById($request->id_project)->id_syllabus;
        $project->save();
        return $project;
    }

    public function edit(Request $request){
        $project = ProjectDone::findById($request->id);
        $project->id_user = $request->id_user;
        $project->id_project = $request->id_project;
        $project->id_syllabus = Projects::getIdSyllabusById($request->id_project)->id_syllabus;
        $project->save();
        return $project;
    }

    public function delete(Request $request){
        $project = ProjectDone::findById($request->id);
        $project->delete();
        return $project;
    }
    
    public function getAll(){
        $project = ProjectDone::getAll();
        return $project;
    }

    public function getPercentDoneByIdUser(Request $request)
    {
        // $countProjectDone = ProjectDone::countProjectDoneByIdUser($request->id);
        // $countProjects = Projects::getIdSyllabusById($request->id_project)->id_syllabus;
        
        // $percent = (($countProjectDone / $countProjects) + ($countProjectDone % $countProjects))*100;

        // return $percent;
    }
}