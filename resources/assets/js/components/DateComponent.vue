<template>
  <div class="date-component">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Date component</div>
                <div class="card-body">
                    {{ date }}
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
          dateFormat: {
              type: String,
              default: 'DD MMMM YYYY',
          },
          timeZone: {
              type: String,
              default: 'America/Montreal',
          },
          locale: {
            type: String,
            default: document.documentElement.lang,
          }


        },
        data() {
        return {
            date: '',
            };
        },
        created() {
            this.refreshTime();
            setInterval(this.refreshTime, 1000);

        },
        methods: {
             refreshTime() {
               this.date = moment()
                   .tz(this.timeZone)
                   .locale(this.locale)
                   .format(this.dateFormat);
             },
         },
  }
</script>
