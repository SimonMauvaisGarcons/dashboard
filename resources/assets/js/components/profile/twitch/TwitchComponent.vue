<template>
  <div class="profile-spotify-credentials">
        <notification v-if="show_notification" :informations="notifications_data"></notification>
        <div class="container">
            <h5>Identifiant twitch</h5>
            <div v-if="edit_twitch_id">
                <input type="text" v-model="user" placeholder="New user">
                <button class="btn btn-link" v-on:click="updateTwitchId()">Save</button>
                <button class="btn btn-link" v-on:click="edit_twitch_id = false">Cancel</button>
            </div>
            <div v-else>
                <div v-if="has_twitch">
                    <span class="small text-muted">{{ current_username }} - {{ current_identifiant }}</span>
                    <button class="btn btn-link" v-on:click='edit_twitch_id = true'>edit</button>
                    <a v-bind:href="'https://twitch.tv/'+ current_username " target="_blank">Voir le compte twitch</a>
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
                current_username: this.infos.username,
                current_identifiant: this.infos.identifiant,
                notifications_data: {
                    message: "",
                    type: "",
                }
            };
        },
        created() {
        },
        methods: {
            updateTwitchId() {
                axios
                .get("twitch/update?twitch="+this.has_twitch+"&username="+ this.user +"")
                    .then((response) => {
                        this.edit_twitch_id = false;
                        this.show_notification = true;
                        this.has_twitch = true;

                        this.notifications_data.message = "Vos informations ont bien été mises à jour.";
                        this.notifications_data.type = "alert-success";

                        this.current_username = response.data['data'][0].login;
                        this.current_identifiant = response.data['data'][0].id;



                }).catch((error) => {  
        
                    this.notifications_data.message = "Une erreur s'est produite.";
                    this.notifications_data.type = "alert-danger";

                    this.show_notification = true;
                })

                const self = this;
                setTimeout(function(){
                    self.show_notification = false;
                }, 2000);
            }
        },
  }
</script>
