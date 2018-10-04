<?php
use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post(

	'task', function (Request $request) {

		$user = User::find($request->id);
		
		$task = $user->tasks()->create(
			[
				"title" => $request->title,
				"time" => $request->time
			]
		);
		
		return $task;
	}

);

Route::get(
	'task', function (Request $request) {

		$user = User::find($request->id);
		
		$task = $user->tasks()->create($request->all());
		
		return $task;
	}
);
