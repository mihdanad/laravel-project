<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class CastController extends Controller
{
    public function create(){
    	return view('cast.create');
    }

    public function store(Request $request){
    	$request->validate([
	        'nama' => 'required|max:45',
	        'umur' => 'required',
	        'bio' => 'required',
    	]);

	    DB::table('cast')->insert([
		    'nama' => $request['nama'],
		    'umur' => $request['umur'],
		    'bio' => $request['bio']
		]);

		return redirect('/cast');
    }

    public function index(){
    	$cast = DB::table('cast')->get();
        return view('cast.index', compact('cast'));
    }

    public function show($id){
    	$cast = DB::table('cast')->where('id', $id)->first();
    	return view('cast.show', compact('cast'));
    }

    public function edit($id){
    	$cast = DB::table('cast')->where('id', $id)->first();
    	return view('cast.edit', compact('cast'));
    }

    public function update($id, Request $request){
    	$request->validate([
	        'nama' => 'required|max:45',
	        'umur' => 'required',
	        'bio' => 'required',
    	]);

    	$query = DB::table('cast')
    		->where('id', $id)
    		->update([
    			'nama' => $request['nama'],
    			'umur' => $request['umur'],
    			'bio' => $request['bio']
    		]);
    	return redirect('/cast');
    }

    public function destroy($id){
    	DB::table('cast')->where('id', $id)->delete();
    	return redirect('/cast');
    }

}
