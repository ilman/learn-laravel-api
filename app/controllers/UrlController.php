<?php

class UrlController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$urls = Url::where('user_id', Auth::user()->id)->get();
 
	    return Response::json(array(
	        'error' => false,
	        'urls' => $urls->toArray()),
	        200
	    );
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$url = new Url;
	    $url->url = Request::get('url');
	    $url->description = Request::get('description');
	    $url->user_id = Auth::user()->id;
	 
	    // Validation and Filtering is sorely needed!!
	    // Seriously, I'm a bad person for leaving that out.
	 
	    $url->save();
	 
	    return Response::json(
	    	array(
		        'error' => false,
		        'urls' => $url->toArray()
	        ),
	        200,
	        array(),
	        JSON_PRETTY_PRINT
	    );

	    // curl -i --user firstuser:first_password -d "url=http://google.com&description=A Search Engine"
	    // curl -i --user firstuser:first_password -d "url=http://google.com&description=A Search Engine" localhost/learn/laravel-api/public/api/v1/url
	    // curl -i --user firstuser:first_password -d "url=http://fideloper.com&description=A Great Blog" localhost/learn/laravel-api/public/api/v1/url
 		// curl -i --user seconduser:second_password -d "url=http://digitalsurgeons.com&description=A Marketing Agency" localhost/learn/laravel-api/public/api/v1/url
 		// curl -i --user seconduser:second_password -d "url=http://www.poppstrong.com/&description=I feel for him" localhost/learn/laravel-api/public/api/v1/url

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    // Make sure current user owns the requested resource
	    $url = Url::where('user_id', Auth::user()->id)
	            ->where('id', $id)
	            ->first();
	 
	    return Response::json(array(
	        'error' => false,
	        'urls' => $url->toArray()),
	        200
	    );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$url = Url::where('user_id', Auth::user()->id)->find($id);
		$url->url = Request::get('url');
		$url->description = Request::get('description');

	    $url->save();
	 
	    return Response::json(array(
	        'error' => false,
	        'message' => 'url updated'),
	        200
	    );

	    // curl -i -X PUT --user firstuser:first_password -d 'url=http://yahoo.com' localhost/learn/laravel-api/public/api/v1/url/1
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$url = Url::where('user_id', Auth::user()->id)->find($id);
 
	    $url->delete();
	 
	    return Response::json(array(
			'error' => false,
			'message' => 'url deleted'),
			200
		);

		// curl -i -X DELETE --user firstuser:first_password localhost/learn/laravel-api/public/api/v1/url/1
	}


}
