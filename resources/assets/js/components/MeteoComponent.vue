<template>
  <div class="mete-component">
    Meteo component
    {{ temperature }} degrés Celcius
    {{ icon }}
  </div>
</template>


<script>
  import meteo from '../services/meteo/Meteo';

  export default {

    props: {
      ville: {
        type: String,
        default: "Québec , qc"
      }
    },
    data() {
      return {
        icon: '',
        temperature: '',
        min: '',
        max: '',
      };
    },
    created() {
      this.fetchWeather();
      setInterval(this.fetchWeather, 15 * 60 * 1000);
    },

    methods: {
      async fetchWeather() {
          const conditions = await meteo.conditions(this.ville);
          this.temperature = conditions.temp;
          this.icon = `wi-yahoo-${conditions.code}`;
          this.min = condition.forecast.low;
          this.max = condition.forecast.high;
      },
    },
  };

</script>
