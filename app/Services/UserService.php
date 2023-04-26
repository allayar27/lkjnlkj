<?php

namespace App\Services;

use App\Actions\EmailSender;
use App\Models\User;

final class UserService
{
    /** @var User */
    private $user;

    /** @var EmailSender */
    private $emailSender;

    public function __construct(User $user, EmailSender $emailSender)
    {
        $this->user = $user;
        $this->emailSender = $emailSender;
    }

    public function create(array $request)
    {
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password']
        ];

        $request['password'] = bcrypt($request['password']);
        $create = $this->user->create($request);

        $this->emailSender->send($this->user->email, $data);
        $create->assignRole('user');
        return $create;

    }

}
