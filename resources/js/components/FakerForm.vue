<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-3">
                <div class="d-inline custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="defaultChecked" name="direction"
                           checked value="in" v-model="direction" @click.stop="changeValues">
                    <label class="custom-control-label" for="defaultChecked">In</label>
                </div>

                <div class="d-inline custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="defaultUnchecked" name="direction"
                           value="out" v-model="direction" @click.stop="changeValues">
                    <label class="custom-control-label" for="defaultUnchecked">Out</label>
                </div>
            </div>
            <div class="col-lg-2 col-md-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-sm" name="caller_id" type="text"
                           placeholder="caller_id" value="4401" v-model="caller_id" @keyup="checkValues"
                           @blur="checkValues">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" @click="randCallerId">Random</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-sm" name="called_id" type="text"
                           placeholder="called_id" v-model="called_id" @keyup="checkValues" @blur="checkValues">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" @click="randCalledId">Random</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3">
                <div class="d-inline custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1"
                           name="is_answered" checked>
                    <label class="custom-control-label" for="customCheck1">is_answered</label>
                </div>
            </div>
            <div class="col-lg-1 col-md-2">
                <button class="btn btn-sm btn-success d-inline ml-3" v-bind:class="{ disabled: isDisabled }"
                        v-bind:disabled="isDisabled">Add
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isActive: true,
                isDisabled: false,
                caller_id: '860311222',
                called_id: '4401',
                direction: 'in',
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            checkValues: function () {
                this.isDisabled = !(this.caller_id.length > 3 && this.called_id.length > 3);
            }, changeValues: function () {
                let value = this.caller_id;
                this.caller_id = this.called_id;
                this.called_id = value;
            }, randCallerId: function () {
                this.caller_id = '860' + this.makeid();
            }, randCalledId: function () {
                this.called_id = '860' + this.makeid();
            }, makeid() {
                return Math.floor((Math.random() * 1000000) + 1);
            }
        }
    }
</script>
