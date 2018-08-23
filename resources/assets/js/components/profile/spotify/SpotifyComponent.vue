<template>
  <div class="profile-spotify-credentials">
      <notification v-if="show_notification"></notification>
      <div v-if="credentials.has_credential">
        <button class="btn btn-link" v-on:click="refreshToken()">Réinitialiser vos clés d'identifications</button>
        <br><br>
        <div class="container">
            <h4>Voici vos clés d'identifications</h4>
            <h5>Access token</h5>
            <p class="small text-muted">{{ current_token }}</p>
            <h5>Refresh token</h5>
            <p class="small text-muted">{{ credentials.refresh_token }}</p>
        </div>
      </div>
      <div v-else>
        <a class="btn btn-link" href="/spotify/auth/go" >Connecter votre compte Spotify</a>
      </div>

  </div>
</template>

<script>
    import axios from 'axios';
    import notification from '../Notification';

    export default {
        props: {
            credentials: {},
        },
        components: {
            notification
        },
        data() {
            return {
                current_token: this.credentials.token ,
                show_notification: false,
                
            };
        },
        created() {
            //console.log(this.notification.valide);
        },
        methods: {
         
         refreshToken() {
          axios
          .get("/spotify/refresh")
          	.then((response) => {
                this.updateToken(response);
                
            })
         },
          
        updateToken(response) {
            this.current_token = response.data;
            this.show_notification = true;
            const self = this;
            setTimeout(function(){
                self.show_notification = false;
            }, 2000);
        }
      
        },
  }
</script>
