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
