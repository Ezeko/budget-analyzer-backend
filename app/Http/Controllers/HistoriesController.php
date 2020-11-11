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
     * @OA\Property(property="username", type="string", example="ezekiel"),
     *       @OA\Property(property="description", type="string", example="₦20,000 was added to Education budget plan"),
     *     @OA\Property(property="budget_type", type="string", example="Education"),
     * @OA\Property(property="priority", type="string", example="medium"),
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
        //change request to accept json
       $data = 
            $request->json()->all()
        ;

        //return $data['user_id'];
        // validate $requests

        validator( 
        [
            'user_id' => 'required',
            'username' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'budget_type' => 'required',
            'priority' => 'required',
            
        ]);

        $createHistory = new History();

        $createHistory->user_id = $data['user_id'];
        $createHistory->username = $data['username'];
        $createHistory->amount = $data['amount'];
        $createHistory->description = $data['description'];
        $createHistory->budget_type = $data['budget_type'];
        $createHistory->priority = $data['priority'];

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

        $histories = History::where('user_id', $user_id)->orderBy('id', 'DESC')->get()->limit(0);

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
        
        $histories = History::where('user_id', $user_id)->where('budget_type', $budget_type)->orderBy('id', 'DESC')->get();

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
