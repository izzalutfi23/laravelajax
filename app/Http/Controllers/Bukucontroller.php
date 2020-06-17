<?php

namespace App\Http\Controllers;

use App\Bukumodel;
use Illuminate\Http\Request;
use DataTables;

class Bukucontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Bukumodel::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<button class="btn btn-primary btn-sm edit" data-id="'.$row->id.'" data-target="#edit" data-toggle="modal">Edit</button>';
                           $btn = $btn.' <a href="javascript:void(0)"  data-id="'.$row->id.'" class="btn btn-danger btn-sm deleteBook">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('home');
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
        Bukumodel::create($request->all());

        return response()->json(['success'=>'Book saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bukumodel  $bukumodel
     * @return \Illuminate\Http\Response
     */
    public function show(Bukumodel $bukumodel)
    {
        return $bukumodel;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bukumodel  $bukumodel
     * @return \Illuminate\Http\Response
     */
    public function edit(Bukumodel $bukumodel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bukumodel  $bukumodel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bukumodel $bukumodel)
    {
        Bukumodel::where('id', $bukumodel->id)->update([
            'title' => $request->title,
            'author' => $request->author
        ]);

        return response()->json(['success'=>'Book edit successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bukumodel  $bukumodel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bukumodel $bukumodel)
    {
        //
    }
}
