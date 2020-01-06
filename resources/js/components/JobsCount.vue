<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="progress" v-if="isEnabled">
                    <div class="progress-bar" role="progressbar" :style="style" :aria-valuenow="percent"
                         aria-valuemin="0" aria-valuemax="100">{{ percent }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                percent: 0,
                count: 0,
                rest: 0,
                isEnabled: false,
                style: 'width: ' + this.percent + '%'
            }
        },
        mounted() {
            axios
                .get('/jobs/count')
                .then(response => (this.count = response));
            setTimeout(() => {
                this.checkCount = false;
            }, 2000);
        },
        methods: {
            checkCount: function () {
                axios
                    .get('/jobs/count')
                    .then(response => (this.rest = response));

                if (this.rest > 0) {
                    this.isEnabled = true;
                    this.percent = 100 - (this.rest / this.count) * 100;
                } else {
                    this.isEnabled = false;
                    this.count = 0;
                    this.percent = 0;
                }

                this.style = 'width: ' + this.percent + '%';
            },
        }
    }
</script>
