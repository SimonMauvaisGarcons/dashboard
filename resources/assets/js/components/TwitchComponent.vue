<template>
    <div class="heure-component">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Twitch component</div>
                    <div class="card-body">
                        <template v-if="is_live">
                            <h2>Title: {{ stream_title }}</h2>
                            <h3>User: {{ user }}</h3>
                            <h4>Viewers: {{ viewers }}</h4>
                            <h4>Game: {{ game }}</h4>
                            Logo : <img :src="user_logo" />
                            Preview : <img :src="preview" />
                        </template>
                        <template v-else>
                           <h2>Présentement hors ligne</h2>
                        </template>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {

        },
        data() {
          return {
            viewers: '',
            is_live: '',
            game: '',
            preview: '',
            user: '',
            user_logo: '',
            stream_title: '',
            stream: '',

          };
        },
        created() {
            this.refreshTime();
            setInterval(this.refreshTime, 60000);

        },
        methods: {
             refreshTime() {
                 axios
                .get("/dashboard/twitch")
                .then((response) => {
                   console.log(response)
                   this.updateStream(response);
                })
             },
             updateStream(response) {
                 if(response != null){
                    this.viewers = response.data.stream.viewers;
                    this.is_live = true;
                    this.game = response.data.stream.game;
                    this.preview = response.data.stream.preview.medium;
                    this.user = response.data.stream.channel.name;
                    this.user_logo = response.data.stream.channel.logo;
                    this.stream_title = response.data.stream.channel.status;

                 }else{
                      this.is_live = false;
                 }
         
             }

         },
  }
</script>
