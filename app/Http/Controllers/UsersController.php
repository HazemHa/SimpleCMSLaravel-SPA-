<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends Controller
{
    //

    private static $instance;

    function __construct()
    { }

    public static function  getUsersController()
    {
        if (self::$instance == null) {
            self::$instance = new UsersController();
        }
        return self::$instance;
    }


    public function getAuthenticatedUser(Request $request, $user)
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            $user = Users::find($user->id);
            $user->access_token = JWTAuth::fromUser($user);
            $user->token_type = 'bearer';
            $user->expires_in   = auth('api')->factory()->getTTL() * 180;
            $user->save();
            $_COOKIE["user"] = $user;
            //return response()->json(['token_expired'], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }



    public function checkToken(Request $request)
    {
        if (isset($_COOKIE["user"])) {
            $userCookie = json_decode($_COOKIE["user"]);
            if ($userCookie) {
                $request['token'] = $userCookie->access_token;
                return $this->getAuthenticatedUser($request, $userCookie);
            }
        }
        return response()->json(['user_not_found' => 0], 401);

        // $jwt_user = Users::find($userObj->id);

        //   \Auth('api')->login($jwt_user,true);
        //  dd(JWTAuth::user());


    }

    public function singin(Request $request)
    {
       
        if (JWTAuth::check()) {
            dd(JWTAuth::user());
            return response()->json([
                'auth' => true,
                'user' => JWTAuth::user(),
            ], 200);
        }
        $credentials = $request->only('email', 'password');
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['auth' => false], 401);
        }
        $user = Users::find(JWTAuth::user()->id);
        $user->access_token = JWTAuth::fromUser($user);;
        $user->token_type = 'bearer';
        $user->expires_in   = auth('api')->factory()->getTTL() * 180;
        $user->save();
        return response()->json([
            'auth' => true,
            'user' => $user
        ], 200);
    }
    public function logout(Request $request)
    {
        // Get JWT Token from the request header key "Authorization"
        $token = $request->header("Authorization");
        // Invalidate the token
        try {
            JWTAuth::invalidate($token);
            return response()->json([
                "status" => "success",
                "message" => "User successfully logged out."
            ]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json([
                "status" => "error",
                "message" => "Failed to logout, please try again."
            ], 500);
        }
        /*

        $this->jwt->parseToken()->invalidate();

     //   auth('api')->logout();
        return response()->json([
            'auth' => false,
            'user' => ['id' => -1],
        ], 200);
        */
    }
    public function singup(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'about' => 'required|string',
                'image' => 'nullable|image|max:255',
                'password' => 'required|string|min:6|confirmed',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        try {
            $user = new  Users;
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->about = $request['about']; //
            $user->role_id = 2;
            $user->password = \Hash::make($request['password']);
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('public/profiles');
                $user->image = $path;
            }
            $user->save();
            $token = auth()->login($user);
            $user->access_token = $token;
            $result =  $user->save();
            return response()->json([
                'success' => $result, 'user' => $user, 'access_token' => $token,
                'token_type'   => 'bearer',
                'expires_in'   => auth()->factory()->getTTL() * 60
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['result' => $e->getMessage()]);
        }
    }
    public function profile(Request $request)
    {
        //

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'about' => 'required|string|max:240',
                'password' => 'required|string|min:6|confirmed',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $user = Users::find($request->id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = \Hash::make($request['password']);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/profiles');
            $user->image = $path;
        }

        return response()->json(['success' => $user->save(), 'user' => $user], 200);
    }
    /***Store a newly created resource in storage.*
     *
@param\Illuminate\Http\Request $request *
@return\Illuminate\Http\Response *
     */
    public function store(Request $request)
    {
        /*
 $validatedData = $request->validate([
'name' => 'required',
'email' => 'required',
'email_verified_at' => 'required',
'about' => 'required',
'password' => 'required'
]);
 */

        /*
$validator = Validator::make($request->all(), [
'name' => 'required',
'email' => 'required',
'email_verified_at' => 'required',
'about' => 'required',
'password' => 'required'
]);
if ($validator->fails()) {
return redirect()->back()
->withErrors($validator)
->withInput();
}
 */

        // $request->validated();
        $newRecord = new Users;
        $newRecord->name = $request->name;
        $newRecord->email = $request->email;
        $newRecord->email_verified_at = $request->email_verified_at;
        $newRecord->about = $request->about;
        $newRecord->password = $request->password;
        $result =  $newRecord->save();



        /*
 $newRecord = App\undefined::create(['name'=>$request->name,
'email'=>$request->email,
'email_verified_at'=>$request->email_verified_at,
'about'=>$request->about,
'password'=>$request->password
]);

 */
        return $this->createResponseMessage($result);
    }

    // this for update record :
    /***
Update the specified resource in storage.**
@param\Illuminate\Http\Request $request *
@param int $id *
@return\Illuminate\Http\Response *
     */
    public function update(Request $request, $id)
    {
        /*
 $validatedData = $request->validate([
'name' => 'required',
'email' => 'required',
'email_verified_at' => 'required',
'about' => 'required',
'password' => 'required'
]);
 */

        /*
$validator = Validator::make($request->all(), [
'name' => 'required',
'email' => 'required',
'email_verified_at' => 'required',
'about' => 'required',
'password' => 'required'
]);
if ($validator->fails()) {
return redirect()->back()
->withErrors($validator)
->withInput();
}
 */

        $UpdatedRecord = App\Users::find($id);
        $UpdatedRecord->name = $request->name;
        $UpdatedRecord->email = $request->email;
        $UpdatedRecord->email_verified_at = $request->email_verified_at;
        $UpdatedRecord->about = $request->about;
        $UpdatedRecord->password = $request->password;
        $result = $UpdatedRecord->save();

        /*
 $result = $UpdatedRecord->update($request->all()); */

        return $this->createResponseMessage($result);
    }

    // this for destroy record :
    /***
Remove the specified resource from storage.*
     *
@param int $id *
 @return\Illuminate\Http\Response
     **/
    public function destroy($id)
    {

        $record = App\Users::findOrFail($id);
        $result =  App\Users::destroy($record->id);

        return $this->createResponseMessage(
            $result
        );
    }
}
