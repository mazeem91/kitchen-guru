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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRecipeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRecipeRequest $request)
    {
        $recipe = Recipe::create($request->all());
        $ingredientsIds = $request->input('recipe_ingredients.*.ingredient_id');
        $ingredientsMeasures = DB::table('ingredients')
            ->select('id', 'measure')
            ->whereIn('id', $ingredientsIds)
            ->get()
            ->pluck('measure', 'id');

        foreach ($request->input('recipe_ingredients') as $recipeIngredient) {
            $ingredientId = $recipeIngredient['ingredient_id'];
            $recipe->recipe_ingredients()->create(
                [
                    'recipe_id' => $recipe->id,
                    'ingredient_id' => $ingredientId,
                    'amount' => $recipeIngredient['amount'],
                    'amount_measure' => $ingredientsMeasures[$ingredientId]
                ]
            );
        }
        return new RecipeResource($recipe);
    }

    /**
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
