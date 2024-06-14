<?php

namespace App\Http\Controllers;
use App\Subject;
use App\Traits\ResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
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

        $subjects = Subject::with(['translation','modes'])->get();
        return $this->successResponse($subjects, Response::HTTP_OK);

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
                'subject_title' => 'required|max:100|unique:subjects,subject_title',
                'description' => '',

            ]);



            $subject = Subject::create($validateData);
            $subject->modes()->sync($request->modes);
            return $this->successResponse($subject, Response::HTTP_CREATED);

        } catch (QueryException $exception) {

            return $exception;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($subject)
    {
        //
        $subjects = Subject::with('translation')->where('id',$subject)->get();
        return $this->successResponse($subjects, Response::HTTP_OK);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $subject = Subject::find($id);

        if (!$subject) {
            return $this->errorResponse('could not find category', Response::HTTP_BAD_REQUEST);
        }
        $subject->subject_title = $request->subject_title;
        $subject->description = $request->description;
        $subject->modes()->syncWithoutDetaching($request->modes);

        $subject->save();
        return $this->successResponse($subject, Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function delete($subject)
    {
        //
        $subject = Subject::findorfail($subject);
        $subject->delete();
        return $this->successResponse($subject, Response::HTTP_OK);

    }

    public function restore($subject)
    {
        //
        $subject = Subject::withTrashed()->find($subject)->restore();

        return $this->successResponse($subject, Response::HTTP_OK);

    }
}
