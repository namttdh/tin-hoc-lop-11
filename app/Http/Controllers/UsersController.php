<?php

namespace App\Http\Controllers;

use App\Http\Model\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function create(Request $request){
        $user = new Users();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->level =0;
        $user->save();
        return $user;
    }

    public function edit(Request $request){
        $user = Users::findById($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->level = $request->level;
        $user->save();
        return $user;
    }

    public function delete(Request $request){
        $user = Users::findById($request->id);
        $user->delete();
        return $user;
    }

    public function getPaginate()
    {
        return Users::getPaginate();
        
    }

    public function getAll(){
        return Users::getAll();
    }

    public function findByName(Request $request)
    {
        return Users::findByName($request->name);
    }

}
