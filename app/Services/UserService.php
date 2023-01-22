<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Mail\UserSignUpMail;
use App\Models\User;
use App\Services\Contracts\UserContract;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserService implements UserContract
{
    use ApiResponser;
    
    public function create(UserRequest $request)
    {
        $validated = $request->validated();
        $email = $validated['email'];
        $data = ([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password']
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $create = User::create($validated);
        Mail::to($email)->send(new UserSignUpMail($data));
        if (!$create){
           return $this->error('creating process is failed!',400);
        }
        
        $create->assignRole('user');
        return $this->success([
            $create,
            'token' => $create->createToken('api_token')->plainTextToken,
        ],'created successfully!',201);
    }

    public function update(UserRequest $request, $id)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $update = User::where('id', $id)->update($validated);
        if(!$update){
            return $this->error('Updating is failed!',400);
        }
        return $this->success($update,'Updated successfully!',200);
    }

    public function delete($id)
    {
        $delete = User::findOrFail($id)->delete();
        return $this->success($delete,'deleted successfully!',200);
    }
}
