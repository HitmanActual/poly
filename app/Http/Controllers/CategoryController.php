<?php

namespace App\Http\Controllers;

use App\Category;
use App\Traits\ResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
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
        $categories = Category::with(['subcategories'])->get();
        return $this->successResponse($categories, Response::HTTP_OK);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {

            $validateData = $request->validate([
                'category_title' => 'required|max:50',
                'thumbnail_path' => '',
                'description' => '',

            ]);

            if ($request->hasFile('thumbnail_path')) {


                $file = $request->file('thumbnail_path');
                $extension = $file->getClientOriginalExtension();

                $newName = md5(microtime()) . time() . '.' . $extension;
                $file->storeAs('/public/category', $newName);

                $validateData['thumbnail_path'] = $newName;
            }


            $category = Category::create($validateData);
            return $this->successResponse($category, Response::HTTP_CREATED);

        } catch (QueryException $exception) {

            return $exception;
        }


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show($category)
    {
        //
        $category = Category::findOrFail($category)->get();
        return $this->successResponse($category, Response::HTTP_CREATED);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = Category::find($id);

        if (!$category) {
            return $this->errorResponse('could not find category', Response::HTTP_BAD_REQUEST);
        }

        $category->category_title = $request->category_title;
        $category->description = $request->description;



        if ($request->hasFile('thumbnail_path')) {

            $media = basename($category->thumbnail_path);

            unlink(storage_path("app/public/category/".$media));

            $file = $request->file('thumbnail_path');
            $extension = $file->getClientOriginalExtension();

            $newName = md5(microtime()) . time() . '.' . $extension;
            $file->storeAs('/public/category', $newName);

            $category->thumbnail_path = $newName;
        }

        $category->save();
        return $this->successResponse($category, Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function delete($category)
    {
        //
        $category = Category::findorfail($category);
        $category->delete();
        return $this->successResponse($category, Response::HTTP_OK);

    }

    public function restore($category)
    {
        //
        $category = Category::withTrashed()->find($category)->restore();

        return $this->successResponse($category, Response::HTTP_OK);

    }

}
