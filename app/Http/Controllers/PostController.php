<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Requests\storepostrequest;
use Illuminate\Support\Str;
use App\Jobs\PruneOldPostsJob;
use App\Http\Controllers\Controller;
use App\Notifications\NewPostNotify;
use Illuminate\Support\Facades\Notification;
use App\Model\user\Subscriber;
use Illuminate\Notifications\Notifiable;


class PostController extends Controller
{
    public function index()
    {
        // PruneOldPostsJob::dispatch();
        //executes job to delete post which is id>20
        $posts = post::paginate(5);
        //select data based on passed parameter
        // $posts->append($request->all());
        return view('posts.index', [
            'posts' =>
            $posts
        ]);
    }
    public function create()
    {
        //select *from posts where id=5;
        //query users table in create action that render create forn to full data
        $users = user::all();

        //    dd($users);
        //all cause i want to get all user
        return view('posts.create', ['users' => $users]);
    }
    public function store(storepostrequest $request)
    {

        // dd($request->all());
    //     //validation here before data request
    //     request()->validate([
    //         //take array contain validation rule
    //         'title'=>['required','min:4','title' => 'unique:App\Models\post,title'],
    //         'description'=>['required','min:10'],
    // composer require barryvdh/laravel-debugbar --dev
    //         //key
    //     ], [
    //         //override required massege
    //    'title.required'=>'overrided required massege',
    //    'title.min'=>'changed the min rule for msg title'
    //    //if i want to use this validation in other place or validation take too much line
    //    //to solve that can make an external file or seperate function
    //     ]

    //     );
        $requestdata = request()->all();

        // post::create([
        //array take column name and value to add in this column
        // 'title'=>$requestdata['title'],
        //title parameter here comes here from form name
        // 'description'=>$requestdata['description'],
        //should put every column in fillable
        //  ] );
        post::create($requestdata);
       // $subscribers = User::all(); //Retrieving all subscribers
 
    //     foreach($subscribers as $subscriber){
    //         Notification::route('mail' , $subscriber->email) //Sending mail to subscriber
    //                       ->notify(new NewPostNotify($requestdata)); //With new post
 
    //     return redirect()->back();
    //   }
        //redirection to posts.index
        return redirect()->route('posts.index');
        //elquent=model
    }
    public function show($postId)
    {
        $post = Post::find($postId);
        //change date style
        $date = Carbon::parse($post->created_at)->format('l jS \of F Y h:i:s A');
        return view('posts.show', [
            'post' => $post,
            'date' => $date,
        ]);
    }
    public function edit($postId)
    {
        return view('posts.edit', [
            'post' => post::find($postId),
            'users' => User::all(),
        ]);
    }
    public function update(Request $request, $postId)
    {
        // @dd($request->all());
        post::where('id', $postId)->update([
            'title' => $request->all()['title'],
            'description' => $request->all()['description'],
            'user_id' => $request->all()['post_creator'],
        ]);
        return redirect()->route('posts.index');
    }

    public function destroy($postID)
    {
        post::where('id', $postID)->delete();

        return redirect()->route('posts.index');
    }
}
