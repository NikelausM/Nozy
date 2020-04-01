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

/**
* Provides data fields and methods to manipulate a PHP data-type representing a Comment resource in a PHP application.
* @author Nozy team
*
*/
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

      $notificationController = new NotificationController();
      $notificationController->storeComment(Post::find($request->post_id));
    }
    catch (\GuzzleHttp\Exception\RequestException $e) {
      Session::flash("store_comment_error_".$request->unique_id, "unable to post comment at the moment.\r\nplease try again later...");
    }
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
    Log::info("Tring to show comment");
    try {
      $client = new \GuzzleHttp\Client(['base_uri' => 'http://ec2-3-101-22-8.us-west-1.compute.amazonaws.com/']);
      $api_response = $client->request('GET','/api/comment/id/'.$id);
      $comment = json_decode($api_response->getBody());

      Log::info('Microservice status code');
      Log::info($api_response->getStatusCode());
      Log::info('Microservice headers');
      foreach ($api_response->getHeaders() as $name => $values) {
        Log::info($name . ': ' . implode(', ', $values) . "\r\n");
      }
      Log::info('Microservice body');
      Log::info($api_response->getBody());
      $api_reponse_body = json_decode($api_response->getBody());
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
        return redirect()->back()->withErrors($validator,'updateCommentErrors');
      }
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
    return redirect()->back();
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy(Request $request, $id)
  {
    try {
      Log::info('Trying to destroy comment');
      $comment = array('CommentId' => $id);
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
      $api_reponse_body = json_decode($api_response->getBody());
    }
    // Catch request related errors
    catch (\GuzzleHttp\Exception\RequestException $e) {
      Session::flash("destroy_comment_error_".$request->unique_id, "unable to delete comment at the moment.\r\nplease try again later...");
    }
    // Catch other PHP errors
    catch (\Exception $e) {
      Session::flash("destroy_comment_error_".$request->unique_id, "unable to delete comment at the moment.\r\nplease try again later...");
    }
    // Catch api specific error
    if (array_key_exists("error", $api_reponse_body) && $api_reponse_body->error) {
      Session::flash("destroy_comment_error_".$request->unique_id, "unable to delete comment at the moment.\r\nplease try again later...");
    }
    return redirect()->back();
  }

  /**
  * Remove the specified resource from storage with only id.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroyWithOnlyId($id)
  {
    try {
      Log::info('Trying to destroy comment with only id');
      $comment = array('CommentId' => $id);
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

      // Prioritize deletion
      $commentController = new CommentController();
      $api_response = $commentController->show($id);
    }
    // Catch request related errors
    catch (\GuzzleHttp\Exception\RequestException $e) {
      Log::info("\GuzzleHttp\Exception\RequestException error found when deleting comment with only id");
    }
    // Catch other PHP errors
    catch (\Exception $e) {
      Log::info("PHP error found when deleting comment with only id".$e->getMessage());
    }
  }
}
