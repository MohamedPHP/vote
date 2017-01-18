<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Question;
use App\Answer;
use App\Suggestion;
use App\Country;
use Auth;
use Response;
use DB;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        // incoming request
        $email = $request['email'];
        $pass  = $request['password'];

        // check incoming data
        if (Auth::attempt(['email' => $email, 'password' => $pass])) {
            $user = User::where('email', $email)->select('id as user_id', 'username', 'phone', 'email', 'img_path', 'country_id')->first();
            return Response::json(['status' => "success", "user" => $user], 200); // if data are right will send it to khaled
        }

        // when error
        $error = null;
        if (count(User::where('email', $email)->get())  == 0) {
            $error = "email dose not exsists";
        }elseif (count(User::where('email', $email)->get())  == 1 && User::where('email', $email)->first()->password != bcrypt($pass)) {
            $error = "password is not correct";
        }

        // when success
        return Response::json(['status' => "unsuccess", "error" => $error], 200);
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->username     = $request['username'];
        $user->img_path     = $this->upload($request['image']);
        $user->phone        = $request['phone'];
        $user->email        = $request['email'];
        $user->password     = bcrypt($request['password']);
        $user->country_id   = $request['country_id'];
        $user->save();

        if ($user) {
            $userdata = User::find($user->id)->select('id as user_id', 'username', 'phone', 'email', 'img_path', 'country_id')->first();
            return Response::json(['status' => "success", "user" => $userdata], 200); // if data are right will send it to khaled
        }
        return Response::json(['status' => "unsuccess", "error" => "there was an error during registration please try again later"], 200);
    }


    public function upload($file){
        $extension = $file->getClientOriginalExtension();
        $sha1 = sha1($file->getClientOriginalName());
        $filename = date('Y-m-d-h-i-s')."_".$sha1.".".$extension;
        $path = public_path().'src/images/users';
        $file->move($path, $filename);
        return 'src/images/users/'.$filename;
    }



    public function UsernameValidation(Request $request)
    {
        if (count(User::where('username', $request['username'])->get()) == 0) {
            return Response::json(['status' => "valid"], 200);
        }
        return Response::json(['status' => "invalid"], 200);
    }




    public function QuestionsGetAll()
    {
        $question = Question::orderBy('id', 'desc')
                    ->select('id as question_id', 'content')
                    ->get();
        if (!$question) {
            return Response::json(['status' => "unsuccess"], 200);
        }
        return Response::json(['status' => "success", "question-list" => $question], 200);
    }



    public function highestTrend()
    {
        $sql = 'select id as question_id, content from questions where total_voting = (select max(`total_voting`) from questions)';
        $question = DB::select(DB::raw($sql));
        return Response::json(['response' => $question], 200);
    }



    public function previousVoting(Request $request)
    {
        $userid = $request['user_id'];
        $prevVoting = Answer::where('user_id', $userid)->orderBy('created_at', 'desc')->get();
        $idContainer = []; // make empty array
        foreach ($prevVoting as $answer) { // store each id in the $idContainer array
            $idContainer[] = $answer->question_id;
        }
        $question = [];
        foreach ($idContainer as $id) { // loop the questions ans store it into $question array
            $question[] = Question::where('id', $id)->select('id as question_id', 'content')->first();
        }

        // when success return the status with success and the question list with the data
        return Response::json(['status' => "success", "question-list" => $question], 200);
    }


    public function search(Request $request)
    {
        $searchword = $request['search_word'];
        $question = Question::where('content', 'LIKE', '%'.$searchword.'%')->orderBy('created_at', 'ASC')->select('id as question_id', 'content')->get();
        return Response::json(["results" => $question], 200);
    }


    public function vote(Request $request)
    {
        $user_id     = $request['user_id'];
        $question_id = $request['question_id'];
        $vote_val    = $request['vote_val']; // opposed, supporter, unintersted


        // add the answer
        $answer = new Answer();
        $answer->vote_val    = $vote_val;
        $answer->question_id = $question_id;
        $answer->user_id     = $user_id;
        $answer->save();

        // update the opposed, supporter, unintersted counters
        $question = Question::findOrFail($answer->question_id);
        if ($vote_val == "opposed") {
            $aopposed_counter = $question->aopposed_counter;
            $question->aopposed_counter = $aopposed_counter + 1;
        }
        if ($vote_val == "supporter") {
            $supportes_counter = $question->supportes_counter;
            $question->supportes_counter = $supportes_counter + 1;
        }
        if ($vote_val == "unintersted") {
            $unintersted_counter = $question->unintersted_counter;
            $question->unintersted_counter = $unintersted_counter + 1;
        }
        $question->save();

        // update the total voting counter
        $questionTotalVoting = Question::findOrFail($answer->question_id);
        $aopposed_counter = $question->aopposed_counter;
        $supportes_counter = $question->supportes_counter;
        $unintersted_counter = $question->unintersted_counter;
        $questionTotalVoting->total_voting = $aopposed_counter + $supportes_counter + $unintersted_counter;
        $questionTotalVoting->save();

        // when success return the status with success
        return Response::json(["status" => "success"], 200);
    }


    public function suggestAvote(Request $request)
    {
        $user_id = $request['user_id'];
        $content = $request['content'];
        $suggestion = new Suggestion();
        $suggestion->content = $content;
        $suggestion->user_id = $user_id;
        $suggestion->save();
        return Response::json(["status" => "success"], 200);
    }


    public function CountriesGetAll()
    {
        $countries = Country::select('id as country_id', 'name as country_name')->get();
        return Response::json(["countries" => $countries], 200);
    }

}
