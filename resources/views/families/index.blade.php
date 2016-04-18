@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <a href="{!! route('families.create') !!}" class="btn btn-primary pull-right">+ Add Family</a>

                <div class="clearfix"></div>
                <br/>

                @if($families->count())
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Root Member</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($families as $family)
                            <tr>
                                <td>{{ $family->name }}</td>
                                <td>{{ $family->root_member ? $family->root_member->name : '-' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center">No families found!</p>
                @endif
            </div>
        </div>
    </div>
@endsection
