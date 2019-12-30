<template>
    <div>
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

        <div class="d-inline custom-control">
            <input class="form-control form-control-sm inline" name="caller_id" type="text"
                   placeholder="caller_id" value="4401" v-model="caller_id" @keyup="checkValues">
            <input class="form-control form-control-sm inline" name="called_id" type="text"
                   placeholder="called_id" v-model="called_id" @keyup="checkValues">
        </div>
        <div class="d-inline custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="customCheck1"
                   name="is_answered" checked>
            <label class="custom-control-label" for="customCheck1">is_answered</label>
        </div>
        <button class="btn btn-sm btn-success d-inline ml-3" v-bind:class="{ disabled: isDisabled }"
                v-bind:disabled="isDisabled">Add
        </button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                isActive: true,
                isDisabled: true,
                caller_id: '',
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
            },
            changeValues: function () {
                let value = this.caller_id;
                this.caller_id = this.called_id;
                this.called_id = value;
            }
        }
    }
</script>
