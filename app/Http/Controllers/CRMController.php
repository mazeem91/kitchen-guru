<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\RecipeIngredientResource;

class CRMController extends Controller
{

    /**
     * @OA\Get(
     *      path="/crm/ingredients-required",
     *      operationId="ListIngredientsRequired",
     *      tags={"CRM"},
     *      summary="Get list of Ingredients Required",
     *      description="Returns list of Ingredients Required",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="order_date",
     *          description="order date",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="date",
     *              example="2022-07-10"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/RecipeIngredient")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function getRequiredIngredients(Request $request)
    {
        $fromDate = $request->query('order_date', Carbon::now()->toDateString());
        $toDate = Carbon::parse($fromDate)->addDays(7)->toDateString();

        $result = DB::table('recipe_ingredients', 'ri')
            ->join('member_box_recipe', 'ri.recipe_id', '=', 'member_box_recipe.recipe_id')
            ->join('member_boxes', 'member_box_recipe.member_box_id', '=', 'member_boxes.id')
            ->selectRaw('ri.ingredient_id, sum(ri.amount) as amount, ri.amount_measure')
            ->whereDate('member_boxes.delivery_date', '>=', $fromDate)
            ->whereDate('member_boxes.delivery_date', '<=', $toDate)
            ->groupBy('ri.ingredient_id', 'ri.amount_measure')
            ->get();

        return RecipeIngredientResource::collection($result);
    }
}
