<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|string|min:8',
            'cpassword' => 'required|string|same:password'
        ], [
            'name.required' => "Name is required",
            'email.required' => "Email is required",
            'email.email' => "Enter a vaild Email",
            'email.unique' => "Enter a unique Email",
            'password.min' => 'Password Should contain at least 8 chars',
            'password.required' => 'Password is required',
            'cpassword.same' => "passwords didn't match",
            'cpassword.required' => "confirm password please"
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}