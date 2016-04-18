@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h3>{{ $member->name }}</h3>

                <hr/>
                
                {!! Form::open(['url' => "members/{$member->id}/relation"]) !!}

                <div class="form-group">
                    <input class="btn btn-primary center-block" type="submit" value="Is Root of Family?" name="is_root">
                </div>

                <h2 class="text-center">OR</h2>

                <!--- Family id Field --->
                <div class="form-group col-md-4 col-md-offset-4">
                    {!! Form::label('parent_id', 'Is Child of:') !!}
                    {!! Form::select('parent_id', $familyMembers, null, ['class' => 'form-control']) !!}
                </div>

                <div class="clearfix"></div>

                <!--- Submit Field --->
                <div class="form-group">
                    <input class="btn btn-primary center-block" type="submit" value="Submit" name="is_child">
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection