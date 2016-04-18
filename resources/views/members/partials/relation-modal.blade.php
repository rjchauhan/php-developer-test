<div class="modal fade" id="relation-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@{{ current_member.name }}</h4>
            </div>
            <div class="modal-body">

                <button type="button" class="btn btn-primary center-block" v-on:click="setRootOfFamily()" data-dismiss="modal">Is Root of Family?</button>

                <h2 class="text-center">OR</h2>

                <div class="form-group" v-if="family_members.length">
                    <label for="">Is Child of:</label>
                    <select v-model="parent_id" class="form-control">
                        <option v-for="member in family_members" v-bind:value="member.id">@{{ member.name }}</option>
                    </select>
                </div>
                <p v-else class="text-center">No members found for family! Please add more members to continue.</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" v-on:click="setRelationship()" data-dismiss="modal">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>