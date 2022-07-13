<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="MemberBoxResource",
 *     description="MemberBox resource",
 *     @OA\Xml(
 *         name="MemberBoxResource"
 *     )
 * )
 */
class MemberBoxResource extends JsonResource
{
    /**
     * @OA\Property(title="Data wrapper")
     *
     * @var \App\Models\MemberBox[]
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
            'user_id' => $this->user_id,
            'delivery_date' => $this->delivery_date,
            'recipes' => RecipeResource::collection($this->recipes),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
