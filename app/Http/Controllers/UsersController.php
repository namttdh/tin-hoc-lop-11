<?php

namespace App\Http\Controllers;

use App\Http\Model\Users;
use App\Http\Model\Projects;
use App\Http\Model\Syllabus;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function create(Request $request)
    {
        $user = new Users();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->level = 0;
        $user->save();
        return $user;
    }

    public function edit(Request $request)
    {
        $user = Users::findById($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != "") {
            $user->password = bcrypt($request->password);
        }
        $user->level = $request->level;
        $user->save();
        return $user;
    }
    public function updateProfile(Request $request)
    {
        $user = Users::findById($request->user()->id);
        $user->name = $request->name;
        if ($request->password != "") {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return $user;
    }

    public function delete(Request $request)
    {
        $user = Users::findById($request->id);
        $user->delete();
        return $user;
    }

    public function getPaginate()
    {
        return Users::getPaginate();

    }

    public function getAll()
    {
        return Users::getAll();
    }

    public function findByName(Request $request)
    {
        return Users::findByName($request->name);
    }

    public function countUser()
    {
        return Users::countAllUser();
    }

    public function getProfile(Request $request)
    {
        return $request->user();
    }

    public function count()
    {
        $s = Syllabus::countAllSyllabus();
        $p = Projects::countAllProjects();
        $u = Users::countAllUser();

        return ["count_syllabus"=>$s,
            "count_project"=>$p,
            "count_user"=>$u];
    }

}
