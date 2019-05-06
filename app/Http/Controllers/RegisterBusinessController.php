<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegisterBusiness;

class RegisterBusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regbusinesses = RegisterBusiness::all();
        return view('registerbusiness.index', compact('regbusinesses'));

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
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str, true);


        if ((is_array($json_obj)) && (count($json_obj) > 0)) {

            $busname = $json_obj[0]["busname"];
            $cat = $json_obj[0]["cat"];
            $phone = $json_obj[0]["phone"];
            $logo = "caro.jpg";
            $location = $json_obj[0]["location"];

            RegisterBusiness::create([
                'business_name' => $busname, 'category' => $cat, 'phone_number' => $phone, 'logo' => $logo, 'location' => $location
            ]);
        }

    }
    public function webhook(Request $request)
    {
        // $validToken = $request->validationToken;
        // dd($validToken);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
