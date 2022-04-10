<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use App\Models\chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $request->merge(['status' => 1]);
        $request->merge(['created_at' => date('Y-m-d h:i:s')]);
        $request->merge(['updated_at' => null]);
        
        $data = chat::create($request->all());
        $id = $data['id'];

        $users = json_decode($request['user_chat']);
        // $new = [];

        foreach ($users as $val) {
            $data_new = User::find($val);
            $list = json_decode($data_new['chats']);

            array_push($list, $id);
            $data_new->update(
                ['chats' => json_encode($list)]
            );
        }

        return $this->success($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = chat::find($id);

        $chats = json_decode($data['data_chat']);
        if (!empty($chats)) 
            $data['data_chat'] = $chats;

        $users = json_decode($data['user_chat']);
        $new = [];
        foreach ($users as $j) {
            $usr = User::select('name', 'picture')->where('id', $j)->get()->first();
            array_push($new, array(
                'user' => $j,
                'name' => $usr['name'],
                'picture' => $usr['picture']
            ));
        }
        $data['user_chat'] = $new;

        return $this->success($data);
    }

    public function showList($id)
    {
        $data = User::find($id);
        $name = $data['name'];
        $picture = $data['picture'];

        $chats = json_decode($data['chats']);
        $new = [];

        // loop chats in User
        if (!empty($chats)) 
        {
            foreach ($chats as $val) {
                $data = chat::find($val);
                $data_chat = json_decode($data['data_chat']);

                $data_new = end($data_chat);
                $data_new->id = $val;
                
                // get name in User
                foreach (json_decode($data['user_chat']) as $j) {
                    if ($j != $id)
                    {
                        $usr = User::select('name', 'picture')->where('id', $j)->get()->first();
                        $data_new->name = $usr['name'];
                        $data_new->picture = $usr['picture'];
                    }
                }

                array_push($new, $data_new);
            }
        }

        return $this->success($new);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = chat::find($id);
        $chats = json_decode($data['data_chat']);
        $req = $request->all();

        array_push($chats, $req);

        date_default_timezone_set('Asia/Jakarta');
        $request->merge(['data_chat' => json_encode($chats)]);
        $request->merge(['updated_at' => null]);

        $data->update($request->all());
        return $this->success($chats);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(chat $chat)
    {
        //
    }
}
