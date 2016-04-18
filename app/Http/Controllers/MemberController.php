<?php

namespace App\Http\Controllers;

use App\Family;
use App\Member;
use App\Http\Requests;
use App\Jobs\SendMessageOnSlack;
use App\Http\Requests\LinkFamilyRequest;
use App\Http\Requests\SetRelationRequest;
use App\Http\Requests\CreateMemberRequest;

class MemberController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('auth');

        $this->user = auth()->user();
    }

    public function index()
    {
        $members = $this->user->members()->with('family')->get();

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(CreateMemberRequest $request)
    {
        $member = $this->user->members()->create($request->all());

        dispatch(new SendMessageOnSlack($member));

        alert()->success('Success!', 'Member created successfully.');

        return redirect()->route('members.index');
    }

    /**
     * Show family link view
     *
     * @param Member $member
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getLinkFamily(Member $member)
    {
        // Get all families
        $families = $this->user->families()->lists('name', 'id');

        if (!$families->count()) {
            alert()->overlay('Note!', 'Please add at least one family to continue.');

            return back();
        }

        return view('members.link-family', compact('member', 'families'));
    }

    /**
     * Link member to family
     *
     * @param Member $member
     * @param LinkFamilyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLinkFamily(Member $member, LinkFamilyRequest $request)
    {
        $family = Family::findOrFail($request->family_id);

        $member->attachToFamily($family);

        alert()->success('Success!', "Member linked to {$family->name} family.");

        return redirect()->route('members.index');
    }

    /**
     * Show set relation view
     *
     * @param Member $member
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getRelation(Member $member)
    {
        // Get all family members except current member
        $familyMembers = Member::where('id', '<>', $member->id)
            ->where('family_id', $member->family_id)
            ->lists('name', 'id');

        if (!$familyMembers->count()) {
            alert()->overlay('Note!', 'Please add more members to set relation');

            return back();
        }

        return view('members.relation', compact('member', 'familyMembers'));
    }

    /**
     * Save relationship between members
     *
     * @param Member $member
     * @param SetRelationRequest $request
     * @return \Illuminate\Http\RedirectResponse
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

        alert()->success('Success!', 'Member relationship set successfully.');

        return redirect()->route('members.index');
    }

    /**
     * Dynamic web page built with Vue.JS [for Demo]
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function indexVue()
    {
        return view('members.index-vue');
    }
}
