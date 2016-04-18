<?php

namespace App\Http\Controllers\API;

use App\Member;
use App\Family;
use App\Http\Requests;
use App\Jobs\SendMessageOnSlack;
use App\Http\Controllers\Controller;
use App\Http\Requests\LinkFamilyRequest;
use App\Http\Requests\SetRelationRequest;
use App\Http\Requests\CreateMemberRequest;

class MemberController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function index()
    {
        return $this->user->members()->with('family')->get();
    }

    /**
     * Create new member
     *
     * @param CreateMemberRequest $request
     * @return mixed
     */
    public function store(CreateMemberRequest $request)
    {
        $member = $this->user->members()->create($request->all());

        dispatch(new SendMessageOnSlack($member));

        return $member;
    }

    /**
     * Link member to family
     *
     * @param Member $member
     * @param LinkFamilyRequest $request
     * @return Member
     */
    public function linkFamily(Member $member, LinkFamilyRequest $request)
    {
        $family = Family::findOrFail($request->family_id);

        $member->attachToFamily($family);

        return $member;
    }

    /**
     * Get family members for current user
     *
     * @param Member $member
     * @return mixed
     */
    public function familyMembers(Member $member)
    {
        return Member::where('id', '<>', $member->id)
            ->where('family_id', $member->family_id)
            ->get(['id', 'name']);
    }

    /**
     * Save relationship between members
     *
     * @param Member $member
     * @param SetRelationRequest $request
     * @return Member
     */
    public function postRelation(Member $member, SetRelationRequest $request)
    {
        if ($request->has('is_child')) {
            $parent = Member::findOrFail($request->parent_id);

            $member->isChildOf($parent);
        }

        if ($request->has('is_root')) {
            $member->makeFamilyRoot();
        }

        $member->load('family');

        return $member;
    }
}
