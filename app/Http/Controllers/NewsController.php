<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $allnews = News::withTrashed()->paginate(4);
           $alltashed = News::onlyTrashed()->get();
        return view('news.index',['allnews'=>$allnews,'alltashed'=>$alltashed]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       request()->validate([
          'title'=>'required',
           'desc'=>'required',

       ]);
       $allnews = new News;
        $allnews->title = $request->title;
        $allnews->desc = $request->desc;
        $allnews->user_id = $request->user_id;

        $allnews->save();
        return back();

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
    public function delete($id=null){
        if ($id != null){
            $del = News::find($id);
            $del->delete();
        }elseif (request()->has('restore') && \request()->has('id')){
             News::whereIn('id',request('id'))->restore();
        }elseif (\request()->has('forceDelete') && \request()->has('id')){
            News::whereIn('id',\request('id'))->forceDelete(request('id'));
        }elseif ( \request()->has('softDelete') && \request()->has('id')){
            News::destroy(\request('id'));
        }


        return redirect()->route('news.index');
    }
}
