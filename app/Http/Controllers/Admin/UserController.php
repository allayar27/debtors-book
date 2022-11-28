<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdate;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    
    public function create()
    {
        return view('admin.users.create');
    }

    
    public function store(UserRequest $request)
    {
        $validate = $request->validated();
        $create = User::create($validate);
        if ($create){
            return redirect()->route('user.index');
        }
        

    }

   
    public function show($id)
    {
        
    }

    
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

   
    public function update(UserUpdate $request, $id)
    {
        $validate = $request->validated();
        $update = User::where('id', $id)->update($validate);
        if($update){
            return redirect(route('user.index'));
        }
        
    }

  
    public function destroy($id)
    {
        //
    }
}
