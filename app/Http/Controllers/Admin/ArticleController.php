<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flobbos\Crudable\Contracts\Crud;
use Exception;

class ArticleController extends Controller{
    
    protected $articles;

    public function __construct(Crud $articles) {
        $this->articles = $articles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.articles.index')->with(['articles'=>$this->articles->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $this->validate($request, []);
        
        try{
            $this->articles->create($request->all());
            return redirect()->route('admin.articles.index')->withMessage(trans('crud.record_created'));
        } catch (Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        return view('admin.articles.show')->with(['article'=>$this->articles->find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        return view('admin.articles.edit')->with(['article'=>$this->articles->find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $this->validate($request, []);
        
        try{
            $this->articles->update($id, $request->all());
            return redirect()->route('admin.articles.index')->withMessage(trans('crud.record_updated'));
        } catch (Exception $ex) {
            return redirect()->back()->withInput()->withErrors($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        try{
            $this->articles->delete($id);
            return redirect()->route('admin.articles.index')->withMessage(trans('crud.record_deleted'));
        } catch (Exception $ex) {
            return redirect()->route('admin.articles.index')->withErrors($ex->getMessage());
        }
    }
}

