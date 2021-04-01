<?php
/* ------------------------------------------------------------------------------------------------------------ */
namespace App\Http\Controllers\API;
/* ------------------------------------------------------------------------------------------------------------ */
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
/* ------------------------------------------------------------------------------------------------------------ */
class RegisterController extends BaseController {
    /* ------------------------------------------------------------------------------------------------------------ */
    public function info()  {
        return 'Toto je info';
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    public function register(Request $request)    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['username'] = $user->username;
        return $this->sendResponse($success, 'User register successfully.');
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    public function login(Request $request)    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] = $user->createToken('MyApp')-> accessToken; 
            $success['username'] = $user->username;
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
    /* ------------------------------------------------------------------------------------------------------------ */
    public function logout(Request $request)    {
        if (Auth::check()) {
            $success=$request->user()->tokens->each(function ($token, $key) {
                $token->delete();
            });
            return $this->sendResponse($success, 'User logout successfully.');
          }
    }
    /* ------------------------------------------------------------------------------------------------------------ */
}
