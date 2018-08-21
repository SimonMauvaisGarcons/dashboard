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


                        <h2>Song name : {{ title }}</h2>
                        <h3>Album name: {{ album }}</h3>
                        <img :src="imageUrl" />
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
            title: '',
            album: '',
            imageUrl: '',
        };
    },
    created() {
        this.refreshTime();
        setInterval(this.refreshTime, 5000);

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
        refreshTime() {
           this.getCurrentSong();
        },

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
          	.then((response) => {
                this.updateSong(response)
            })
        },

        updateSong(response){
            this.title = response.data.item.name;
            this.album = response.data.item.album.name;
            this.imageUrl = response.data.item.album.images[0].url;
        }

     },
}
</script>
