<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BudgetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /** 
     * @OA\Get(
     * path="/api/budgets/{user_id}",
     * summary="Gets all user's budget",
     * description="Create budgets ",
     * operationId="Budgets",
     * tags={"Budgets"},
     * 
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong user details. Please try again")
     *        )
     *     ),
     *  * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="response", type="string", example="success")
     *        )
     *     )
     * )
     */
    public function index($userId)
    {
        //
        $budgets = User::where('user_id', $userId)->get(['Savings', 'Education', 'Rent', 'Feeding', 'Entertainment', 'Gifts', 'Miscellaneous', 'Others'])[0];

        if (($budgets)){
            return response()->json([
                'response' => 'success',
                'data' => $budgets,
                
            ], 200);
        } else {
            return response()->json([
                'message' => 'something occur',
                'response' => 'error',
                
            ], 400);
        }
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

    /**
     * @OA\Get(
     * path="/api/budgets/{user_id}/{budget_type}",
     * summary="Get single budget",
     * description="Get all budget of a particular type amount belonging to a particular user user",
     * operationId="GetBudget",
     * tags={"Budgets"},
     * 
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong user details. Please try again")
     *        )
     *     ),
     *  * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Success"),
     *  @OA\Property(property="data", type="object", example="data objects")
     *        )
     *     )
     * )
     */
    public function getBudget($user_id, $budget_type){
        
        $budget = User::where('user_id', $user_id)->get([$budget_type])[0];

        if ( $budget ){

                return response()->json([
                    'response' => 'success',
                    'data' => $budget,
                ], 200);
            
        } else {
            return response()->json([
                'message' => 'Budget not found',
                'response' => 'error',
            ], 404);
        }

    }

}
