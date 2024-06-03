<?php

namespace App\Http\Controllers;

use App\Country;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CountryController extends Controller
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
        $countries = Country::all();
        return $this->successResponse($countries,Response::HTTP_OK);
    }

}
