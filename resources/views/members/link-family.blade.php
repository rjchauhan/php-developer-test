@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h3>{{ $member->name }}</h3>

                <hr/>

                {!! Form::open(['url' => "members/{$member->id}/link-family"]) !!}

                <!--- Family id Field --->
                <div class="form-group">
                    {!! Form::label('family_id', 'Belongs to Family:') !!}
                    {!! Form::select('family_id', $families, null, ['class' => 'form-control']) !!}
                </div>

                <!--- Submit Field --->
                <div class="form-group">
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

{{--
@section('scripts')
    <script>
        new Vue({
            el: 'body',

            data: {
                family_id: 0,
                member_id: 0,
                families: [],
                members: []
            },

            ready: function() {
                this.getFamilies();
            },

            methods: {
                // Get user families
                getFamilies: function() {
                    this.$http.get('/api/families').then(function(result){
                        this.$set('families', result.data);
                    });
                },

                // Get members of family
                getMembers: function(familyId) {
                    this.$http.get('/api/families/' + familyId +  '/members').then(function(result){
                        this.$set('members', result.data);
                    });
                }
            }
        });
    </script>
@endsection--}}
