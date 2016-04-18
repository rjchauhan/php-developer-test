@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default">
                    <div class="panel-heading">Add Family</div>

                    <div class="panel-body">
                        {!! Form::open(['url' => 'families']) !!}

                            <!--- Name Field --->
                            <div class="form-group">
                                {!! Form::label('name', 'Name:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Family Name']) !!}
                            </div>

                            <!--- Submit Field --->
                            <div class="form-group">
                                {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
