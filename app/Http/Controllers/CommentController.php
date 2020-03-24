<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Post;
use App\LikeDislike;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        Log::info('Trying to store comment');
        // Check that all required fields are filled
        $validator = Validator::make($request->all(), [
                'post_id' => 'required',
                'user_id' => 'required',
                'body' => 'required',
                'parent_id' => 'required',
            ]);
        // If required filed aren'tflled
        if ($validator->fails()) {
          Session::flash("store_comment_error_".$request->unique_id, "unable to post comment at the moment.\r\nplease try again...");
          Session::put('unique_id', 0); // reset unique id
          return redirect()->back()->withErrors($validator,'storeCommentErrors');
        }
        $comment = array('PostId' => $request->post_id, 'UserId' => $request->user_id, 'Body' => $request->body, 'ParentId' => $request->parent_id);
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://ec2-3-101-22-8.us-west-1.compute.amazonaws.com/']);
        $api_response = $client->request('POST','/api/comment/new',[ 'form_params' => $comment]);
        Log::info('Microservice status code');
        Log::info($api_response->getStatusCode());
        Log::info('Microservice headers');
        foreach ($api_response->getHeaders() as $name => $values) {
            Log::info($name . ': ' . implode(', ', $values) . "\r\n");
        }
        Log::info('Microservice body');
        Log::info($api_response->getBody());
      }
      catch (\GuzzleHttp\Exception\RequestException $e) {
        Session::flash("store_comment_error_".$request->unique_id, "unable to post comment at the moment.\r\nplease try again later...");
      }
      Session::put('unique_id', 0); // reset unique id
      return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      try {
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://ec2-3-101-22-8.us-west-1.compute.amazonaws.com/']);
        $api_response = $client->request('GET','/api/comment/id/'.$id);
        $comment = json_decode($api_response->getBody());
      }
      catch (\GuzzleHttp\Exception\RequestException $e) {
        $comment = collect(json_decode(json_encode(array(array("message" => "no comment available at the moment.\r\nplease try again later...",
                                  "status" => "error"), 404))));
        Session::flash("show_comment_error", $comment->message);
      }
      if (array_key_exists("message", $comment) && !array_key_exists("body", $comment)) {
        Session::flash("no_comment_message", $comment->message);
      }
      return $comment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try {
        Log::info('Trying to update comment');
        // Check that all required fields are filled
        $validator = Validator::make($request->all(), [
                'comment_id' => 'required',
                'post_id' => 'required',
                'user_id' => 'required',
                'body' => 'required',
                'parent_id' => 'required',
            ]);
        // If required filed aren'tflled
        if ($validator->fails()) {
          Session::flash("update_comment_error_".$request->unique_id, "unable to update comment at the moment.\r\nplease try again...");
          Session::put('unique_id', 0); // reset unique id
          return redirect()->back()->withErrors($validator,'updateCommentErrors');
        }
        Log::info('Trying to update post');
        $comment = array('CommentId' =>$request->comment_id, 'PostId' => $request->post_id, 'UserId' => $request->user_id, 'Body' => $request->body, 'ParentId' => $request->parent_id);
        Log::info($comment);
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://ec2-3-101-22-8.us-west-1.compute.amazonaws.com/']);
        $api_response = $client->request('POST','/api/comment/update',[ 'form_params' => $comment]);

        // Log response
        Log::info('Microservice status code');
        Log::info($api_response->getStatusCode());
        Log::info('Microservice headers');
        foreach ($api_response->getHeaders() as $name => $values) {
            Log::info($name . ': ' . implode(', ', $values) . "\r\n");
        }
        Log::info('Microservice body');
        Log::info($api_response->getBody());
      }
      catch (\GuzzleHttp\Exception\RequestException $e) {
        Session::flash("update_comment_error_".$request->unique_id, "unable to update comment at the moment.\r\nplease try again later...");
      }
      Session::put('unique_id', 0); // reset unique id
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      try {
        Log::info('Trying to destroy comment');
        $comment = array('CommentId' => $request->comment_id, 'PostId' => $request->post_id, 'UserId' => $request->user_id);
        $client = new \GuzzleHttp\Client(['base_uri' => 'http://ec2-3-101-22-8.us-west-1.compute.amazonaws.com/']);
        $api_response = $client->request('POST','/api/comment/delete',[ 'form_params' => $comment]);
        Log::info('Microservice status code');
        Log::info($api_response->getStatusCode());
        Log::info('Microservice headers');
        foreach ($api_response->getHeaders() as $name => $values) {
            Log::info($name . ': ' . implode(', ', $values) . "\r\n");
        }
        Log::info('Microservice body');
        Log::info($api_response->getBody());
      }
      catch (\GuzzleHttp\Exception\RequestException $e) {
        Session::flash("destroy_comment_error_".$request->unique_id, "unable to delete comment at the moment.\r\nplease try again later...");
      }
      catch (\Exception $e) {
        Session::flash("destroy_comment_error_".$request->unique_id, "unable to delete comment at the moment.\r\nplease try again later...");
      }
      Session::put('unique_id', 0); // reset unique id
      return redirect()->back();
    }
}
