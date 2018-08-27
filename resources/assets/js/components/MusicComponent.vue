<template>
  <div class="music-component">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card card-default">
                  <div class="card-header">Music component</div>

                  <div class="card-body" v-if="spotify">
                        <h2>Song name : {{ title }}</h2>
                        <h3>Album name: {{ album }}</h3>
                        <img :src="imageUrl" />
                        <p v-show="is_playing">Currently playing</p>
                  </div>
                  <div class="card-body" v-else>
                      <h2>Spotify est présentement indisponible.</h2>
                      <p>Sois une publicité entre les chansons. Sois l'application n'est pas ouverte.</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>


//import spotify from '../services/spotify/Spotify';

export default {
    props: {
    },
    data() {
        return {
            spotify: false,
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

        this.getCurrentSong();
    },
    methods: {
        refreshTime() {
          this.getCurrentSong();
        },
        getCurrentSong() {
          axios
          .get("/spotify/current-song")
          	.then((response) => {
                this.updateSong(response)
            })
        },
        updateSong(response){

            console.log(response);

            if(response.data.item === null || response.data === ""){
                this.spotify = false;
            }else{
                this.spotify = true;
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
