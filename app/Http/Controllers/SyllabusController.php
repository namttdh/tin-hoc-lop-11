<?php

namespace App\Http\Controllers;

use App\Http\Model\Syllabus;
use App\Http\Model\Projects;
use Illuminate\Http\Request;
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
        $project = Projects::deleteByIdSyllabus($request->id);
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
        $data = [];

        foreach ($syllabus as $k) {
            $data[$k->id_group_syllabus][] = ['id_syllabus' => $k->id, 'name_syllabus' => $k->syllabus_name];
            // $data[$k->id_group_syllabus][]  = ['id_syllabus'=> $k->id];
        }

        return $data;
    }

    public function getListSyllabusByGroup()
    {
        $syllabus = Syllabus::getListSyllsbus();
        $data = [];

        foreach ($syllabus as $k) {
            $data[$k->id_group_syllabus]['name'] = $k->name_group_syllabus;
            $data[$k->id_group_syllabus]['syllabus'][] = ['id_syllabus' => $k->id, 'name_syllabus' => $k->syllabus_name];
            // $data[$k->id_group_syllabus][]  = ['id_syllabus'=> $k->id];
        }

        return $data;
    }

    public function countSyllabus()
    {
        return Syllabus::countAllSyllabus();
    }
}
