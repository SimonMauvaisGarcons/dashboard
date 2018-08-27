<template>
  <div class="profile-notification container">
      <p class="alert" :class="informations.type">{{ informations.message }}</p>
  </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            informations: {} 
        },
        data() {
            return {
                valide: 'false',
            };
        },
        created() {

        },
        methods: {
         
        },
  }
</script>