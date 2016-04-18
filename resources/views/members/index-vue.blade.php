@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add-member-modal">+ Add Member</button>

                <div class="clearfix"></div>

                <br/>

                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Family</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="member in members">
                        <td>@{{ member.name }}</td>
                        <td>@{{ member.family ? member.family.name : '-' }}</td>
                        <td>
                            <button type="button"
                                    data-toggle="modal"
                                    data-target="#link-family-modal"
                                    class="btn btn-primary"
                                    v-on:click="setCurrentMember(member)">
                                Link to Family
                            </button>

                            <button type="button"
                                    data-toggle="modal"
                                    data-target="#relation-modal"
                                    class="btn btn-primary"
                                    v-if="member.family_id"
                                    v-on:click="getFamilyMembers(member)">
                                Set Relation
                            </button>

                            <a href="/family/tree/@{{ member.id }}"
                               v-if="member.family_id && member.parent_id !== 0"
                               class="btn btn-info">
                                Family Tree
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>

                @include('members.partials.link-family-modal')
                @include('members.partials.relation-modal')
                @include('members.partials.add-member-modal')
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        new Vue({
            el: 'body',

            data: {
                name: "",
                members: [],
                families: [],
                family_id: 0,
                parent_id: 0,
                current_member: {},
                family_members: [],
                current_member_id: 0,
                token: '{{ csrf_token() }}'
            },

            ready: function () {
                this.getMembers();
                this.getFamilies();
            },

            methods: {
                // Get members
                getMembers: function () {
                    this.$http.get('/api/members').then(function (result) {
                        this.$set('members', result.data);
                    });
                },

                // Get families
                getFamilies: function () {
                    this.$http.get('/api/families').then(function (result) {
                        this.$set('families', result.data);
                        this.family_id = this.families[0].id;
                    });
                },

                // Get family members
                getFamilyMembers: function(member) {
                    this.setCurrentMember(member);

                    this.$http.get('/api/familyMembers/' + member.id).then(function (result) {
                        this.$set('family_members', result.data);
                        this.parent_id = this.family_members[0].id;
                    });
                },

                // Attach member to family
                attachFamily: function () {
                    this.$http.post('/api/members/' + this.current_member.id + '/link-family', {family_id: this.family_id, _token: this.token}).then(function (result) {
                        this.findAndReplaceMember(result.data);
                        this.family_id = this.families[0].id;
                    });
                },

                // Set relationship between members
                setRelationship: function() {
                    this.$http.post('/api/members/' + this.current_member.id + '/relation', {parent_id: this.parent_id, is_child: true, _token: this.token}).then(function (result) {
                        this.findAndReplaceMember(result.data);
                    });
                },

                // Set member as a root of family
                setRootOfFamily: function() {
                    this.$http.post('/api/members/' + this.current_member.id + '/relation', {is_root: true, _token: this.token}).then(function (result) {
                        this.findAndReplaceMember(result.data);
                    });
                },

                // Save new member
                saveMember: function() {
                    this.$http.post('/api/members', {name: this.name, _token: this.token}).then(function (result) {
                        this.addMember(result.data);
                        this.name = "";
                    });
                },

                // Find and replace member
                findAndReplaceMember: function(member) {
                    for(var i in this.members) {
                        if(this.members[i].id == member.id) {
                            this.members.$set(i, member);
                        }
                    }
                },

                // Push new member
                addMember: function(member) {
                    this.members.push(member);
                },

                // Set current member
                setCurrentMember: function (member) {
                    this.current_member = member;
                }
            }
        });
    </script>
@endsection