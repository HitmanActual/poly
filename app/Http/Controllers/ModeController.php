<?php

namespace App\Http\Controllers;

use App\Mode;
use App\Traits\ResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpParser\Node\Expr\AssignOp\Mod;

class ModeController extends Controller
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
        $modes = Mode::all();
        return $this->successResponse($modes, Response::HTTP_OK);

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
                'title' => 'required|max:50',
            ]);

            $mode = Mode::create($validateData);
            return $this->successResponse($mode, Response::HTTP_CREATED);

        } catch (QueryException $exception) {

            return $exception;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function show($mode)
    {
        //
        $mode = Mode::findOrFail($mode);
        return $this->successResponse($mode, Response::HTTP_OK);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $mode = Mode::find($id);

        if (!$mode) {
            return $this->errorResponse('could not find category', Response::HTTP_BAD_REQUEST);
        }

        $mode->title = $request->title;

        $mode->save();
        return $this->successResponse($mode, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mode  $mode
     * @return \Illuminate\Http\Response
     */
    public function delete($mode)
    {
        //
        $mode = Mode::findorfail($mode);
        $mode->delete();
        return $this->successResponse($mode, Response::HTTP_OK);

    }

    public function restore($mode)
    {
        //
        $mode = Mode::withTrashed()->find($mode)->restore();

        return $this->successResponse($mode, Response::HTTP_OK);

    }
}
