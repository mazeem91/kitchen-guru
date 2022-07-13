<?php

namespace App\Http\Controllers;

use App\Models\MemberBox;
use Illuminate\Http\Request;
use App\Http\Resources\MemberBoxResource;
use App\Http\Requests\StoreMemberBoxRequest;
use App\Http\Requests\UpdateMemberBoxRequest;

class MemberBoxController extends Controller
{
    /**
     * @OA\Get(
     *      path="/member-boxes",
     *      operationId="getMemberBoxesList",
     *      tags={"MemberBoxes"},
     *      summary="Get list of member-boxes",
     *      description="Returns list of member-boxes",
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
     *          @OA\JsonContent(ref="#/components/schemas/MemberBoxResource")
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
        $paginator = MemberBox::paginate(10, ['*'], 'page', $page);
        return MemberBoxResource::collection($paginator);
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
     *      path="/member-boxes",
     *      operationId="storeMemberBox",
     *      tags={"MemberBoxes"},
     *      summary="Store new member-box",
     *      description="Returns member-box data",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreMemberBoxRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/MemberBoxResource")
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
     * @param  \App\Http\Requests\StoreMemberBoxRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberBoxRequest $request)
    {
        $request->merge(['user_id' => $request->user()->id]);
        $memberBox = MemberBox::create($request->all());
        $memberBox->recipes()->attach($request->input('recipe_ids'));
        return new MemberBoxResource($memberBox);
    }

    /**
     * @OA\Get(
     *      path="/member-boxes/{id}",
     *      operationId="getMemberBoxById",
     *      tags={"MemberBoxes"},
     *      summary="Get member-box information",
     *      description="Returns member-box data",
     *      security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="MemberBox id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/MemberBoxResource")
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
     * @param  \App\Models\MemberBox  $memberBox
     * @return \Illuminate\Http\Response
     */
    public function show(MemberBox $memberBox)
    {
        return new MemberBoxResource($memberBox);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MemberBox  $memberBox
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberBox $memberBox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMemberBoxRequest  $request
     * @param  \App\Models\MemberBox  $memberBox
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMemberBoxRequest $request, MemberBox $memberBox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MemberBox  $memberBox
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberBox $memberBox)
    {
        //
    }
}
