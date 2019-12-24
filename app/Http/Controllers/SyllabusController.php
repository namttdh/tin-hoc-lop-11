<?php

namespace App\Http\Controllers;

use App\Http\Model\Syllabus;
use App\Http\Model\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Param;

class SyllabusController extends Controller
{
    public function create(Request $request)
    {
        $syllabus = new Syllabus();
        $syllabus->name = $request->name;
        $syllabus->sub_name = "";
        $syllabus->id_group = $request->id_group;
        $syllabus->save();
        return $syllabus;
    }

    public function edit(Request $request)
    {
        $syllabus = Syllabus::findById($request->id);
        $syllabus->name = $request->name;
         $syllabus->sub_name = "";
        $syllabus->id_group = $request->id_group;
        $syllabus->save();
        return $syllabus;
    }

    public function delete(Request $request)
    {
        $project= Projects::deleteByIdSyllabus($request->id);
        $syllabus = Syllabus::findById($request->id);
        $syllabus->delete();
        return $syllabus;
    }


    public function getAll()
    {
        $syllabus = Syllabus::getAll();
        return $syllabus;
    }

    public function getPaginateGroupSyllabus()
    {
        $syllabus = Syllabus::getPaginateGroupSyllabus();
        return $syllabus;
    }

    public function getPaginateSyllabus()
    {
        $syllabus = Syllabus::getPaginateSyllabus();
        return $syllabus;
    }

    public function findByName(Request $request)
    {
        $syllabus = Syllabus::findByName($request->name);
        return $syllabus;
    }

    public function test()
    {
        $syllabus = Syllabus::getListSyllsbus();
        // $data (
        //     'id_group_syllabus' => array (
        //         'syllabus_name' => 
        //     )
        // )
        $array = (array) $syllabus;

        print_r($array['*items']);
        // return print_r($array['id_group_syllabus']);
    }
}
