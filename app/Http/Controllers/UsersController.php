<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     **/
    public function index()
    {
        //
    }

     /** 
     * @OA\Post(
     * path="/api/user/create",
     * summary="Create a user",
     * description="Create new user ",
     * operationId="newUser",
     * tags={"Users"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass users credentials",
     *    @OA\JsonContent(
     *       required={"user_id","email", "name", "username"},
     *       @OA\Property(property="user_id", type="string", format="id", example="flutW0MZyjQikx7mPpslUq37ryl1"),
     *       @OA\Property(property="email", type="email", format="email", example="abc@example.com"),
     * @OA\Property(property="username", type="string", example="Ezekiel"),
     *       @OA\Property(property="name", type="string", example="Ezekiel Adejobi"),
     
     * ),),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong user details. Please try again")
     *        )
     *     ),
     *  * @OA\Response(
     *    response=201,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="User Stored Successfully")
     *        )
     *     )
     * )
     */

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
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
