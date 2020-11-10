<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoriesController extends Controller
{
    //
    /**
     * @OA\Post(
     * path="/api/history/create",
     * summary="Create history",
     * description="Create new budget history",
     * operationId="History",
     * tags={"History"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass history credentials",
     *    @OA\JsonContent(
     *       required={"user_id","amount", "description", "budget_type"},
     *       @OA\Property(property="user_id", type="string", format="id", example="flutW0MZyjQikx7mPpslUq37ryl1"),
     *       @OA\Property(property="amount", type="number", format="number", example="12345"),
     *       @OA\Property(property="description", type="string", example="₦20,000 was added to Education budget plan"),
     *     @OA\Property(property="budget_type", type="string", example="Education"),
     *    ),
     * ),
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
     *       @OA\Property(property="message", type="string", example="History Created Successfully")
     *        )
     *     )
     * )
     */
    public function createHistory(Request $request){

        // validate $requests

        $this->validate($request, 
        [
            'user_id' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'budget_type' => 'required'
        ]);

        $createHistory = new History();

        $createHistory->user_id = $request->user_id;
        $createHistory->amount = $request->amount;
        $createHistory->description = $request->description;
        $createHistory->budget_type = $request->budget_type;

        $created = $createHistory->save();

        if ($created) {
            return response()->json([
                'message' => 'Budget history created successfully',
                'response' => 'success',
                'data' => []
            ], 201);
            
        } else {
            return response()->json([
                'message' => 'Budget not created',
                'response' => 'error',
            ], 400);
        }


    }

    /**
     * @OA\Get(
     * path="/api/histories/{user_id}",
     * summary="Get histories",
     * description="Get all budget histories by user",
     * operationId="GetHistories",
     * tags={"History"},
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
    public function getHistories($user_id){

        $histories = History::where('user_id', $user_id)->get();

        if ( $histories ){

            if (count($histories) > 0){
                return response()->json([
                    'response' => 'success',
                    'data' => $histories,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'No history found for this user',
                    'response' => 'success',
                    'data' => $histories,
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'Budget not found',
                'response' => 'error',
            ], 404);
        }
    }

    /**
     * @OA\Get(
     * path="/api/histories/{user_id}/{budget_type}",
     * summary="Get single history",
     * description="Get all budget of a particular type histories belonging to a particular user user",
     * operationId="GetHistory",
     * tags={"History"},
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
    public function getHistory($user_id, $budget_type){
        
        $histories = History::where('user_id', $user_id)->where('budget_type', $budget_type)->get();

        if ( $histories ){

            if (count($histories) > 0){
                return response()->json([
                    'response' => 'success',
                    'data' => $histories,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'No ' .$budget_type. ' history found for this user',
                    'response' => 'success',
                    'data' => $histories,
                ], 200);
            }
        } else {
            return response()->json([
                'message' => 'Budget not found',
                'response' => 'error',
            ], 404);
        }

    }
}
