<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponser;

    public function findUser($email)
    {
        $data = User::select('name', 'email', 'picture')
                    ->where('email', 'LIKE', '%'.$email.'%')
                    ->get();
        return $this->success($data);
    }
}
