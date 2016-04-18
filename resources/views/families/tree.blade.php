@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <h3>{{ $family->name }} Family</h3>

                <hr/>

                <ul>
                    @if($rootMember->id == $member->id)
                        <li><strong>{{ $rootMember->name }}</strong></li>
                    @else
                        <li>{{ $rootMember->name }}</li>
                    @endif

                    @if(count($rootMember->children_recursive))
                        @include('families.partials.list-members', ['members' => $rootMember->children_recursive])
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
