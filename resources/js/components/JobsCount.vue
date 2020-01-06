<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="progress" v-if="isEnabled">
                    <div class="progress-bar" role="progressbar" :style="style" :aria-valuenow="percent"
                         aria-valuemin="0" aria-valuemax="100">{{ percent }} %
                    </div>
                </div>
                <div v-if="isCompleted">{{ performance }} sec.</div>
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
                isCompleted: false,
                performance: 0,
                style: 'width: ' + this.percent + '%'
            }
        },
        mounted() {
            setInterval(function () {
                this.checkCount()
            }.bind(this), 3000);
            axios
                .get('/jobs/count')
                .then((response) => {
                    this.count = parseInt(response.data);
                });
            this.performance = performance.now();
        },
        methods: {
            checkCount: function () {
                console.log('checkCount called');
                axios
                    .get('/jobs/count')
                    .then((response) => {
                        this.rest = parseInt(response.data);

                        if (this.rest > 0) {
                            this.isEnabled = true;
                            this.percent = Math.floor(100 - (this.rest / this.count) * 100);
                        } else {
                            if (!this.isCompleted && this.count > 0) {
                                this.performance = Math.floor((performance.now() - this.performance) / 1000);
                                this.isCompleted = true;
                                this.isEnabled = false;
                            }
                            this.count = 0;
                            this.percent = 0;
                        }

                        this.style = 'width: ' + this.percent + '%';
                    });
            },
        }
    }
</script>
