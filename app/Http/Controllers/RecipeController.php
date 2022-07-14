<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\RecipeResource;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;

class RecipeController extends Controller
{
    /**
     * @OA\Get(
     *      path="/recipes",
     *      operationId="getRecipesList",
     *      tags={"Recipes"},
     *      summary="Get list of recipes",
     *      description="Returns list of recipes",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="page",
     *          description="Page number",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer",
     *              default=1
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/RecipeResource")
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $paginator = Recipe::paginate(10, ['*'], 'page', $page);
        return RecipeResource::collection($paginator);
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
     * @OA\Post(
     *      path="/recipes",
     *      operationId="storeRecipe",
     *      tags={"Recipes"},
     *      summary="Store new recipe",
     *      description="Returns recipe data",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreRecipeRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/RecipeResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipeRequest $request)
    {
        $ingredientsIds = $request->input('recipe_ingredients.*.ingredient_id');
        $ingredientsMeasures = DB::table('ingredients')
            ->select('id', 'measure')
            ->whereIn('id', $ingredientsIds)
            ->get()
            ->pluck('measure', 'id');

        $recipeIngredientsData = [];
        foreach ($request->input('recipe_ingredients') as $recipeIngredient) {
            $ingredientId = $recipeIngredient['ingredient_id'];
            $recipeIngredientsData[] = [
                'ingredient_id' => $ingredientId,
                'amount' => $recipeIngredient['amount'],
                'amount_measure' => $ingredientsMeasures[$ingredientId]
            ];
        }

        $recipe = Recipe::create($request->all());
        $recipe->recipe_ingredients()->createMany($recipeIngredientsData);
        return new RecipeResource($recipe);
    }

    /**
     * @OA\Get(
     *      path="/recipes/{id}",
     *      operationId="getRecipeById",
     *      tags={"Recipes"},
     *      summary="Get recipe information",
     *      description="Returns recipe data",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="Recipe id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/RecipeResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     * Display the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        return new RecipeResource($recipe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRecipeRequest  $request
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        //
    }
}
