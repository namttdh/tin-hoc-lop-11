<?php


namespace App\Http\Controllers;


use App\Http\Model\GroupSyllabus;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test($id){
        return GroupSyllabus::findById($id);
    }
    public function testAuth(Request $request){
        return $request->user();
    }
}
