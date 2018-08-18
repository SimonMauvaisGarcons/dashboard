<template>
    <div class="heure-component">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Heure component</div>
                    <div class="card-body">
                        {{ time }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment-timezone';
    export default {
          props: {

            timeFormat: {
                type: String,
                default: 'HH:mm:ss',
            },
            timeZone: {
                type: String,
                default: 'America/Montreal',
            },

        },
        data() {
          return {
            time: '',
          };
        },
        created() {
            this.refreshTime();
            setInterval(this.refreshTime, 1000);

        },
        methods: {
             refreshTime() {
                 this.time = moment()
                     .tz(this.timeZone)
                     .format(this.timeFormat);
             },
         },
  }
</script>
