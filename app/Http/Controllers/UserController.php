<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Validation data
     */
    protected function data_validation(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'email_verified_at' => '',
            'password' => 'required',
            'remember_token' => ''
        ]);
    }

    /**
     * Create or Update User
     */
    protected function create_user(Request $request, User $user = null)
    {
        if (!$user) {
            $user = new User();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = $request->email_verified_at;
        $user->password = bcrypt($request->password);
        $user->remember_token = $request->remember_token;

        $user->save();

        return $user;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return response()->json(
            $users
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->data_validation($request);

        $user = $this->create_user($request);

        return response()->json($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('bookversions.book')
            ->where('id', $id)
            ->get();

        return response()->json(
            $user
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->data_validation($request);

        $user =  User::findOrFail($id);
        $updated_user = $this->create_user($request, $user);

        return response()->json($updated_user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete();

        return 'User successfully deleted!';
    }

    public function stats(string $id)
    {
        $user_books = User::with('bookVersions')
            ->where('id', $id)
            ->first()
            ->bookVersions
            ->count();

        return response()->json([
            'number_of_books' => $user_books
        ]);
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
            'email' => 'email|required',
            'password' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'msg' => 'incorrect username or password'
                ], 401);
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
            'status_code' => 200,
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            ]);

        } catch (Exception $error) {
            return response()->json([
            'status_code' => 500,
            'message' => 'Error in Login',
            'error' => $error,
            ]);
        }
    }

    public function logout(string $id)
    {
        User::find($id)->tokens()->delete();

        return 'user logged out';
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }
}
