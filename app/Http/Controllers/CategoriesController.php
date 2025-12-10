<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

// Category টেবিল থেকে শুধু
// ✔ id
// ✔ name
// ✔ type

// ফিল্ডগুলো select করো।

        $categories = Category::select(['id', 'name', 'type']);

        // AJAX Request এসেছে কি না চেক করা
        if($request->ajax()){

// এটাই DataTables কে JSON ডেটা পাঠায়।

// এই ডেটা table-এ চলে যায়:

// id column

// name column

// type column


          return DataTables::of($categories)
    ->addColumn('action', function($row) {
        return '<a href="javascript:void(0)" class=" btn  btn-info btn-sm editButton" data-id="'.$row->id.'">Edit</a> 

        <a href="javascript:void(0)" class="btn btn-danger btn-sm editButton" data-id="'.$row->id.'">Delete</a>';
    })
    ->rawColumns(['action'])
    ->make(true);


        }
         return view('categories.index'); // Blade view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           if($request->category_id != null){

           $category= Category::find($request->category_id);


           if(!$category){
            abort(404);
           }


           $category->update([
             'name' => $request->name,
             'type'=>$request->type
           ]);
            return response()->json([
            'success'=>'categories update successfully'
            ],200);//200 update code
           }



           else{
              // return $request->all();
        $request->validate([
    'name' => 'required|string',
    'type' => 'required|string', 
]);
        // return 'success';

        Category::create([
            'name' => $request->name,
            'type'=> $request->type
        ]);
        return response()->json([
            'success'=>'categories saved successfully'
        ],201);//201 create code


           }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // return $id;
        $category=Category::find($id);
        if(!$category){
            abort(404);
        }
        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
