<template>
  <div class="music-component">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card card-default">
                  <div class="card-header">Music component</div>
                  <div class="card-body">
                        <!-- <button type="button" name="button" v-on:click="login()">Log in to spotify</button> -->
                        <!-- <button type="button" name="button" v-on:click="getAccesToken()">Get access token</button>
                        <button type="button" name="button" v-on:click="getCurrentSong()">Get current song</button> -->
                        <h2>Song name : {{ title }}</h2>
                        <h3>Album name: {{ album }}</h3>
                        <img :src="imageUrl" />

                        <p v-show="is_playing">Currently playing</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>


import spotify from '../services/spotify/Spotify';

export default {
    props: {
    },
    data() {
        return {
            id_song: '',
            title: '',
            album: '',
            imageUrl: '',
            is_playing: false,
        };
    },
    created() {
        this.refreshTime();
        setInterval(this.refreshTime, 5000);
    },
    methods: {
        refreshTime() {
           this.getCurrentSong();
        },
        getCurrentSong() {
          axios
          .get("/dashboard/spotify/current-song")
          	.then((response) => {
                this.updateSong(response)
            })
        },
        updateSong(response){
            if(response.data.item === null){
                this.title = "Je suis pauvre";
                this.album = "Il y a une pub Spotify";
                this.imageUrl = "";
            }else{

                this.is_playing = response.data.is_playing;
                this.title = response.data.item.name;
                this.album = response.data.item.album.name;
                this.imageUrl = response.data.item.album.images[1].url;
                this.id_song = response.data.item.id;
            }

        }
     },
}
</script>
