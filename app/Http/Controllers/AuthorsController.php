<?php

namespace App\Http\Controllers;
use App\Author;
use Session;
use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        
        if($request->Ajax() ){
            $authors = Author::select(['id','name']);
            return Datatables::of($authors)
            ->addColumn('action',function($author){
            return view('datatable._action', ['edit_url'=> route('authors.edit', $author -> id),
            		]);
            })->make(true);
        }
        $html=$htmlBuilder
        ->addColumn(['data'=>'name', 'name='=>'name', 'title'=>'Nama'])
        ->addColumn(['data'=>'action','name'=>'action','title'=>'', 'orderable'=>false, '\searchabel'=>false]);

        return view('authors.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, ['name'=>'required|unique:authors']);
        $author = Author::create($request->only('name'));
        session::flash("flash_notification", [
        	"level"=>"success",
        	"message"=>"Berhasil Menyipan $author->name"
        	]);
        return redirect()->route('authors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
