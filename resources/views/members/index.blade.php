@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <a href="{!! route('members.create') !!}" class="btn btn-primary pull-right">+ Add Member</a>

                <div class="clearfix"></div>

                <br/>

                @if($members->count())
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Family</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->family ? $member->family->name : '-' }}</td>
                                <td>
                                    <a href="{!! route('members.link-family', $member->id) !!}" class="btn btn-primary">Link
                                        to Family</a>
                                    @if($member->belongsToFamily())
                                        <a href="{!! route('members.relation', $member->id) !!}" class="btn btn-primary">Set Relation</a>
                                        @if($member->parent_id !== 0)
                                            <a href="{!! route('family.tree', $member->id) !!}" class="btn btn-info">Family Tree</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">No members found!</p>
                @endif
            </div>
        </div>
    </div>
@endsection
