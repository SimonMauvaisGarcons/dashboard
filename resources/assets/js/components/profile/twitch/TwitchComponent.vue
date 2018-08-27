<template>
  <div class="profile-spotify-credentials">
        <notification v-if="show_notification"></notification>
        <div class="container">
            <h5>Identifiant twitch</h5>
            <div v-if="edit_twitch_id">
                <input type="text" v-model="user">
                <button class="btn btn-link" v-on:click="updateTwitchId()">Save</button>
                <button class="btn btn-link" v-on:click="edit_twitch_id = false">Cancel</button>
            </div>
            <div v-else>

                <div v-if="has_twitch">
                    <button class="btn btn-link" v-on:click='edit_twitch_id = true'>edit</button>
                </div>
                <div v-else>
                    <button class="btn btn-link" v-on:click="edit_twitch_id = true">Ajouter un identifiant</button>
                </div>
                
            </div>           
        </div>
  </div>
</template>

<script>
    import axios from 'axios';
    import notification from '../Notification';

    export default {
        props: {
           infos: {}
        },
        components: {
            notification
        },
        data() {
            return {
                user: '',
                has_twitch: this.infos.has_twitch_id,
                show_notification: false,
                edit_twitch_id: false,
            };
        },
        created() {
        },
        methods: {
            updateTwitchId() {
                axios
                .get("twitch/update?twitch="+this.has_twitch+"")
                    .then((response) => {
                        //this.updateToken(response);
                })

                console.log("je veux update le twitch id");
                this.edit_twitch_id = false;
                this.show_notification = true;
                this.has_twitch = true;
                const self = this;
                setTimeout(function(){
                    self.show_notification = false;
                }, 2000);
            }
        },
  }
</script>
