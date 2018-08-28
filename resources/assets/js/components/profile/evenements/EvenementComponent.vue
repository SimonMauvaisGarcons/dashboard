<template>
  <div class="profile-evenement">
      <!-- <notification v-if="show_notification"></notification> -->     
    <listeevent v-bind:listeevenement="liste"></listeevent>
    <hr>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addevent">Ajouter un evenement</button>
    <addevent></addevent>
  </div>
</template>

<script>
    import axios from 'axios';
    import notification from '../Notification';
    import addevent from './AddEventComponent';
    import listeevent from './ListeEventComponent';


    export default {
        props: {
            liste: {},
        },
        components: {
            notification,
            addevent,
            listeevent,
        },
        data() {
            return {
                show_notification: false,
            };
        },
        created() {
            
        },
        methods: {
          
        },
  }
</script>
