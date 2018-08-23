<template>
  <div class="profile-spotify-credentials">
      <notification v-if="show_notification"></notification>
        <div class="container">
            <h5> Identifiant twitch</h5>
            <div v-if="edit_twitch_id">
                <input type="text" value="Ninja">
                <button class="btn btn-link" v-on:click="updateTwitchId()">Save</button>
            </div>
            <div v-else>
                <span>Ninja</span>
                <button class="btn btn-link" v-on:click='edit_twitch_id = true'>edit</button>
            </div>

           
        </div>
  </div>
</template>

<script>
    import axios from 'axios';
    import notification from '../Notification';

    export default {
        props: {
           
        },
        components: {
            notification
        },
        data() {
            return {
                show_notification: false,
                edit_twitch_id: false,
            };
        },
        created() {
        },
        methods: {
            updateTwitchId() {

                axios
                .get("twitch/update")
                    .then((response) => {
                        //this.updateToken(response);
                    
                })
        
                console.log("je veux update le twitch id");
                this.edit_twitch_id = false;

                this.show_notification = true;
                const self = this;
                setTimeout(function(){
                    self.show_notification = false;
                }, 2000);
            }
        },
  }
</script>
