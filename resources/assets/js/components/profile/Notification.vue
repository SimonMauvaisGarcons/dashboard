<template>
  <div class="profile-notification container">
      <p class="alert alert-success">Vos clés ont bien été réinitialiser</p>
  </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: {
            message: {} 
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