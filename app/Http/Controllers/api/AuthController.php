<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        // Mengambil semua data baik dari JSON maupun dari tabel form-urlencoded
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation Error.', 422, $validator->errors());
        }

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $success['name'] = $user->name;
        $success['email'] = $user->email;

        return $this->success($success, 'User registered successfully.', 201);
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error('Validation Error.', 422, $validator->errors());
        }

        $user = User::where('email', $input['email'])->first();

        if (!$user || !Hash::check($input['password'], $user->password)) {
            return $this->error('Unauthorized.', 401, ['error' => 'Email atau password salah']);
        }

        $success['token'] = $user->createToken('InventoryToken')->plainTextToken;
        $success['name'] = $user->name;

        return $this->success($success, 'Login successful.');
    }
}