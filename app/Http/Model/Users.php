<?php


namespace App\Http\Model;


use Illuminate\Database\Eloquent\Model;

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
        return self::query()->get();
    }

    public function getUsersObject()
    {
        return self::query()->paginate(10);
    }
    public static function findByEmail($email){
        return self::query()->where("email", $email)->first();
    }
}