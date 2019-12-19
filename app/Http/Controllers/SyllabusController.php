<?php

namespace App\Http\Controllers;

use App\Http\Model\Syllabus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SyllabusController extends Controller
{
    public function create(Request $request)
    {
        $syllabus = new Syllabus();
        $syllabus->name = $request->name;
        $syllabus->sub_name = $request->sub_name;
        $syllabus->id_group = $request->id_group;
        $syllabus->save();
        return $syllabus;
    }

    public function edit(Request $request, $id)
    {
        $syllabus = Syllabus::findById($id);
        $syllabus->name = $request->name;
        $syllabus->sub_name = $request->sub_name;
        $syllabus->id_group = $request->id_group;
        $syllabus->save();
        return $syllabus;
    }

    public function delete($id)
    {
        $syllabus = Syllabus::findById($id);
        $syllabus->delete();
        return $syllabus;
    }

    public function getAll()
    {
        $syllabus = Syllabus::getAll();
        return $syllabus;
    }

    public function getObject()
    {
        $object = DB::table("syllabus")
            ->join('group_syllabus', 'syllabus.id_group', '=', 'group_syllabus.id')
            ->select('syllabus.*', 'group_syllabus.*')
            // ->get();
            ->paginate(10);
        return $object;
    }

    public function findByName($name)
    {
        $syllabus = Syllabus::findByName($name);
        return $syllabus;
    }

    public function test()
    {
        $syllabus = Syllabus::getOject();
        return $syllabus;
    }
}
