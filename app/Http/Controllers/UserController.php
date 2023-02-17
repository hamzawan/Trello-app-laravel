<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt_auth', ['except' => ['create']]);
    }
    public function index()
    {
        return response()->json(UserResource::collection(User::latest()->get()), 200);
    }
    public function create(UserRequest $request)
    {
        return response()->json(new UserResource(User::create($request->all())), 201);
    }
    public function show(User $user)
    {
        return response()->json(new UserResource($user), 200);
    }
    public function update(User $user, UserRequest $request)
    {
        $user->update($request->all());
        return response()->json(new UserResource($user), 200);
    }
    public function destroy(User $user)
    {
        $user->delete();
        return response([], 204);
    }
    public function update_profile(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_pic' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $profile_pic_path = store_image($request, 'profile_pic', 'profile_pic');
        $user->update([
            'profile_pic' => $profile_pic_path
        ]);
        return response()->json(new UserResource($user), 200);
    }
    public function update_cover(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cover_pic' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $cover_pic_path = store_image($request, 'cover_pic', 'cover_pic');
        $user->update([
            'cover_pic' => $cover_pic_path
        ]);
        return response()->json(new UserResource($user), 200);
    }
}