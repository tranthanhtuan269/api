<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\QQuestion;
use App\Models\QAnswer;
use Auth;

class HomeController extends Controller
{
    public function login(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(!Auth::attempt($credentials)){
            return response()->json([
                'code' => '200',
                'message' => 'User login fail'
            ]);
        }else{
            $user = Auth::user();
            $token = $user->createToken('token-'.$user->id, ['none']);
            return response()->json([
                'code' => '200',
                'message' => 'User login success',
                'user' => Auth::User(),
                'token' => $token->plainTextToken
            ]);
        }
    }

    public function Register(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(!Auth::attempt($credentials)){
            $user = new \App\Models\User();
            $user->name = 'Admin';
            $user->email = $credentials['email'];
            $user->password = Hash::make($credentials['password']);
            $user->save();

            $token = $user->createToken('token-'.$user->id, ['none']);
            return ['token' => $token->plainTextToken];
        }else{
            $user = Auth::user();
            $token = $user->createToken('token-'.$user->id, ['none']);
            return ['token' => $token->plainTextToken];
        }
    }

    public function test(){
        $homepage = file_get_contents('https://opentdb.com/api.php?amount=50');
        $data = json_decode($homepage);
        
        $list = $data->results;
        foreach($list as $item){
            $slug = Str::of($item->question)->slug('-');
            $check = QQuestion::where('slug', $slug)->first();
            if($check){
                echo 'exited! <br />';
            }else{
                echo 'add new! <br />';
                $question = new QQuestion;
                $question->slug             = Str::of($item->question)->slug('-');
                $question->category_name    = $item->category;
                $question->type             = $item->type;
                $question->difficulty       = $item->difficulty;
                $question->question         = $item->question;
                $question->correct_answer   = $item->correct_answer;
                $question->save();

                foreach($item->incorrect_answers as $incorrect_answer){
                    $answer = new QAnswer;
                    $answer->content = $incorrect_answer;
                    $answer->question_id = $question->id;
                    $answer->save();
                }
            }
        }
        dd(json_decode($homepage));
    }
}
