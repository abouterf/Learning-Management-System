<?php


namespace abouterf\User\Repositories;


use abouterf\User\Models\User;

class UserRepo
{
    public function findByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }
    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function getTeachers()
    {
        return User::permission('teach')->get();
    }
}
