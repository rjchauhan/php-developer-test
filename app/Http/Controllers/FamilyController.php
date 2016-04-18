<?php

namespace App\Http\Controllers;

use App\Member;
use App\Http\Requests;
use App\Http\Requests\CreateFamilyRequest;

class FamilyController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('auth');

        $this->user = auth()->user();
    }

    public function index()
    {
        $families = $this->user->families()->with('root_member')->get();

        return view('families.index', compact('families'));
    }

    public function create()
    {
        return view('families.create');
    }

    public function store(CreateFamilyRequest $request)
    {
        $this->user->families()->create($request->all());

        alert()->success('Success!', 'Family created successfully.');

        return redirect()->route('families.index');
    }

    /**
     * Show family tree
     *
     * @param Member $member
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTree(Member $member)
    {
        // Get member's family
        $family = $member->family;

        // Fetch root member with recursive child members
        $rootMember = Member::where('family_id', $family->id)
            ->where('parent_id', null)
            ->with('children_recursive')
            ->first();

        return view('families.tree', compact('family', 'rootMember', 'member'));
    }
}
