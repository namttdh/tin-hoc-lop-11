<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'level'];

    public static function findById($id)
    {
        return self::query()->where("id", $id)->first();
    }

    public static function getAll()
    {
        return self::query()->select('id', 'name', 'email', 'level')->get();
    }

    public static function findByName($name)
    {
        return self::query()
            ->where('name', 'like', '%' . $name . '%')
            ->select('id', 'name', 'email', 'level')
            ->get();
    }

    public static function getPaginate()
    {
        $users = DB::table('users')
            ->select('id', 'name', 'email', 'level')
            ->paginate(10);
        return $users;
    }

    public function getUsersObject()
    {
        return self::query()->paginate(10);
    }
    public static function findByEmail($email)
    {
        return self::query()->where("email", $email)->first();
    }
}
