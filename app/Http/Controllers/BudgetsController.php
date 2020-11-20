<?php

namespace App\Http\Controllers;

use App\Models\History;
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
        $budgets = User::where('user_id', $userId)->get(['Savings', 'Education', 'Rent', 'Feeding', 'Entertainment', 'Gifts', 'Miscellaneous', 'Others', 'Transport']);

        if (count($budgets) > 0){
            return response()->json([
                'response' => 'success',
                'data' => $budgets[0],
                
            ], 200);
        } else {
            return response()->json([
                'message' => 'user not found',
                'response' => 'error',
                
            ], 404);
        }
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
     *  @OA\Property(property="data", type="object", example="data objects"),
     *  @OA\Property(property="history", type="object", example="histories objects")
     *        )
     *     )
     * )
     */
    public function getBudget($user_id, $budget_type){
        
        $budget = User::where('user_id', $user_id)->get([$budget_type]);

        $history = History::where( 'user_id', $user_id)->where('budget_type', $budget_type)->get();

        if ( count($budget) > 0  && count($history) < 1){

                return response()->json([
                    'response' => 'success',
                    'data' => $budget[0],
                    'history' => []
                ], 200);
            
        } 
        else if (count($budget) > 0 && count($history) > 0){
            return response()->json([
                'response' => 'success',
                'data' => $budget[0],
                'history' => $history[0]
            ], 200);
        }
         else {
            return response()->json([
                'message' => 'Budget not found',
                'response' => 'error',
            ], 404);
        }

    }

}
