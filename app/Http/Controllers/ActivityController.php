<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Traits\ResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    use ResponseTrait;

    protected function authoriza(){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = Auth::id();

        $activity = Activity::with(['translation'])->where('user_id',$user_id)->get();
        return $this->successResponse($activity, Response::HTTP_OK);

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
        $user_id = Auth::id();

        try {

            $validateData = $request->validate([
                'user_id' => 'required',
                'translation_id' => 'required',

            ]);


            if (Auth::check()) {

                $category = Activity::create([
                    'user_id' => $user_id,
                    'translation_id'=>$validateData['translation_id'],
                    ]);
                return $this->successResponse($category, Response::HTTP_CREATED);
            }



        } catch (QueryException $exception) {

            return $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //



    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
