<?php

namespace App\Http\Controllers;

use App\Http\Model\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{

    public function findById($id){
        return Users::findById($id);
    }

    public function getPage()
    {
        $users = DB::table('users')
            ->select('id', 'name', 'email','level')
            ->paginate(10);
        return $users;
    }

    public function getAll(){
        return Users::getAll();
    }



}
