<div class="modal fade" id="link-family-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Select Family</h4>
            </div>
            <div class="modal-body">

                <div class="form-group" v-if="families.length">
                    <select v-model="family_id" class="form-control">
                        <option v-for="family in families" v-bind:value="family.id">@{{ family.name }}</option>
                    </select>
                </div>
                <p v-else class="text-center">No families found! Please add at least one to continue.</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" v-on:click="attachFamily()" data-dismiss="modal">Link</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>