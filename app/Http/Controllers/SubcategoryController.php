<?php

namespace App\Http\Controllers;

use App\Subcategory;
use App\Traits\ResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubcategoryController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subcategories = Subcategory::with(['category'])->get();
        return $this->successResponse($subcategories, Response::HTTP_OK);
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
        try {

            $validateData = $request->validate([
                'subcategory_title' => 'required|max:50',
                'thumbnail_path' => '',
                'description' => '',
                'category_id'=>'required'

            ]);

            if ($request->hasFile('thumbnail_path')) {


                $file = $request->file('thumbnail_path');
                $extension = $file->getClientOriginalExtension();

                $newName = md5(microtime()) . time() . '.' . $extension;
                $file->storeAs('/public/subcategory', $newName);

                $validateData['thumbnail_path'] = $newName;
            }


            $subcategory = Subcategory::create($validateData);
            return $this->successResponse($subcategory, Response::HTTP_CREATED);

        } catch (QueryException $exception) {

            return $exception;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show($subcategory)
    {
        //
        $subcategory = Subcategory::findOrFail($subcategory)->get();
        return $this->successResponse($subcategory, Response::HTTP_CREATED);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $subcategory = Subcategory::find($id);

        if (!$subcategory) {
            return $this->errorResponse('could not find category', Response::HTTP_BAD_REQUEST);
        }

        $subcategory->subcategory_title = $request->subcategory_title;
        $subcategory->description = $request->description;
        $subcategory->category_id = $request->category_id;



        if ($request->hasFile('thumbnail_path')) {

            $media = basename($subcategory->thumbnail_path);
//return $media;
            unlink(storage_path("app/public/subcategory/".$media));

            $file = $request->file('thumbnail_path');
            $extension = $file->getClientOriginalExtension();

            $newName = md5(microtime()) . time() . '.' . $extension;
            $file->storeAs('/public/subcategory', $newName);

            $subcategory->thumbnail_path = $newName;
        }

        $subcategory->save();
        return $this->successResponse($subcategory, Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function delete($subcategory)
    {
        //
        $subcategory = Subcategory::findorfail($subcategory);
        $subcategory->delete();
        return $this->successResponse($subcategory, Response::HTTP_OK);

    }

    public function restore($subcategory)
    {
        //
        $subcategory = Subcategory::withTrashed()->find($subcategory)->restore();

        return $this->successResponse($subcategory, Response::HTTP_OK);

    }
}
