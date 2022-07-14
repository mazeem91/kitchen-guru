<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="RecipeResource",
 *     description="Recipe resource",
 *     @OA\Xml(
 *         name="RecipeResource"
 *     )
 * )
 */
class RecipeResource extends JsonResource
{
    /**
     * @OA\Property(title="Data wrapper")
     *
     * @var \App\Models\Recipe[]
     */
    private $data;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'recipe_ingredients' => RecipeIngredientResource::collection($this->recipe_ingredients),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
