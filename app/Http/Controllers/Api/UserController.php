<?php



namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;

use App\Http\Resources\UserResource;

use App\Models\User;

use Illuminate\Http\Request;



class UserController extends Controller

{

    /**

     * Display a listing of the users.

     */

    public function index()

    {

        $users = User::all();

        return UserResource::collection($users);
    }



    /**

     * Store a newly created user in storage.

     */

    public function store(Request $request)

    {

        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|string|min:6',

        ]);



        $user = User::create([

            'name' => $validated['name'],

            'email' => $validated['email'],

            'password' => bcrypt($validated['password']),

        ]);



        return UserResource::make($user);
    }



    /**

     * Display the specified user.

     */

    public function show(User $user)

    {

        return UserResource::make($user);
    }



    /**

     * Update the specified user in storage.

     */

    public function update(Request $request, User $user)

    {

        $validated = $request->validate([

            'name' => 'sometimes|string|max:255',

            'email' => 'sometimes|email|unique:users,email,' . $user->id,

            'password' => 'sometimes|string|min:6',

        ]);



        if (isset($validated['password'])) {

            $validated['password'] = bcrypt($validated['password']);
        }



        $user->update($validated);



        return UserResource::make($user);
    }



    /**

     * Remove the specified user from storage.

     */

    public function destroy(User $user)

    {

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente.']);
    }
}
