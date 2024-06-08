<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;
use App\Translation;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TranslationController extends Controller
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

        $translation = Translation::all();
        return $this->successResponse($translation, Response::HTTP_OK);

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
        $translations = $request->input('translations');
        //return $translations;
        if (!is_array($translations)) {
            return $this->errorResponse('not array',RESPONSE::HTTP_BAD_REQUEST);
        }

        foreach ($translations as $translation) {
            Translation::create([
                'subject_id' => $translation['subject_id'],
                'language_id' => $translation['language_id'],
                'translated_text' => $translation['translated_text'],
                'description' => $translation['description'],

            ]);
        }
        return $this->successResponse($translation, Response::HTTP_CREATED);


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Translation $translation
     * @return \Illuminate\Http\Response
     */
    public function show($translation)
    {
        //
        $translation = Translation::findOrFail($translation);
        return $this->successResponse($translation, Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Translation $translation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $translation = Translation::find($id);

        if (!$translation) {
            return $this->errorResponse('could not find category', Response::HTTP_BAD_REQUEST);
        }
        $translation->subject_id = $request->subject_id;
        $translation->language_id = $request->language_id;
        $translation->translated_text = $request->translated_text;
        $translation->description = $request->description;
        $translation->status = $request->status;

        $translation->save();
        return $this->successResponse($translation, Response::HTTP_OK);
    }

    public function delete($translation)
    {
        //
        $translation = Translation::findorfail($translation);
        $translation->delete();
        return $this->successResponse($translation, Response::HTTP_OK);

    }

    public function restore($translation)
    {
        //
        $translation = Translation::withTrashed()->find($translation)->restore();

        return $this->successResponse($translation, Response::HTTP_OK);

    }


}
