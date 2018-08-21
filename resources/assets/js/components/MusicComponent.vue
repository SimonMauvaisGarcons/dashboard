<template>
  <div class="music-component">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card card-default">
                  <div class="card-header">Music component</div>
                  <div class="card-body">
                        <!-- <button type="button" name="button" v-on:click="login()">Log in to spotify</button> -->
                        <button type="button" name="button" v-on:click="getAccesToken()">Get access token</button>
                        <button type="button" name="button" v-on:click="getCurrentSong()">Get current song</button>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>

import Echo from "laravel-echo";

export default {


    props: {
    },
    data() {
        return {

        };
    },
    created() {
        // this.refreshTime();
        // setInterval(this.refreshTime, 10000);

        window.Pusher = require('pusher-js');
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: process.env.MIX_PUSHER_APP_KEY,
            cluster: process.env.MIX_PUSHER_APP_CLUSTER,
            encrypted: true
        });

        window.Echo.channel('spotify')
        .listen('SpotifyEvent', (e) => {
            console.log("wassup");
            console.log(e);
        });

    },
    methods: {
        // refreshTime() {
        //   axios
        //   .get("https://api.spotify.com/v1/me/player/currently-playing?code=AQAGnw4aLo0lMuSwVACSIBmRD21xMiaMGOmcFyA4hOKs6wAyehj5RiVi5_phHCypx86nNJo2-TJGs-v9FR4VvDAYjBzkmGupRby4YUQgHAoPG4rirbjmJjph2WShP8CgONIWYXFBqtyui-uI2A8410heFkCOZAS2FpspGeg-VDkUEeA4CzYIQTqzYouI9h5-Wzx4ZuCBYvA3tkQknGGZWLTjEmgb6QKzM9O5Ya6Rrje7-0raz98T52WaGSzO4YBgs86C6IRqAG4PJGQ6s9M")
        //   .then(response => (console.log(response)))
        // },

        login(){
            var scopes = 'user-read-private user-read-email';
            axios.get('https://accounts.spotify.com/authorize?response_type=code&client_id=' + process.env.SPOTIFY_API_ID + (scopes ? '&scope=' + encodeURIComponent(scopes) : '') + '&redirect_uri=' + encodeURIComponent('http://dashboard.test/dashboard/spotify/redirect-uri'));
        },


        getAccesToken() {        
          axios
          .get("/dashboard/spotify/get-access-token")
          .then(response => (console.log(response)))
        },

        getCurrentSong() {
          axios
          .get("/dashboard/spotify/current-song")
          .then(response => (console.log(response)))
        }

     },
}
</script>
