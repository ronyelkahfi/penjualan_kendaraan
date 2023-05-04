<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $contentBody = $request->getContent();
        $decodedContent = json_decode($contentBody);
        
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ];

        $validator = Validator::make((array) $decodedContent, $rules);
        if($validator->fails()){
            $messages = $validator->errors();
            
            return $this->responseError(400,"Bad Request", $messages);
        }
        
        $foundEmail = User::where('email',$request->email)->get();
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if($user){
            return $this->response(201, "Created", $user);
        }
    }
    function response(int $code, string $message, $data){
        return response(json_encode([
            "status" => $code,
            "message" => $message,
            "data" => $data
        ]), $code)
        ->header('Content-Type', 'text/json');
        return $this->response(201,"Created",$result);
    }

    function responseError(int $code, string $message, $constraint){
        return response(json_encode([
            "status" => $code,
            "message" => $message,
            "constraint" => $constraint
        ]), $code)
        ->header('Content-Type', 'text/json');
    }
}
