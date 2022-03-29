<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponser;

    public function findUser($key)
    {
        $data = User::select('id', 'name', 'picture')
                    ->where('name', 'LIKE', '%'.$key.'%')
                    ->get();
        return $this->success($data);
    }

    public function getUser($id)
    {
        $data = User::select('id', 'name', 'picture')
                    ->where('id', $id)
                    ->get()->first();
        return $this->success($data);
    }
}
