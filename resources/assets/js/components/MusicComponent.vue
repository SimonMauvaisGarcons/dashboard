<template>
  <div class="music-component">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card card-default">
                  <div class="card-header">Music component</div>
                  <div class="card-body">
                        <button type="button" name="button" v-on:click="getAccesToken()">Get access token</button>
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
      token: "AQAv_72NnELtISdlievuIoOAz22mVsIpNq9uAlTg1UNcKYWB0k17OGxcYOsRZeSDd0MKwHzPKOqhPcFx3NXzM94wcpII7iRRloOwGA93JJBDcZBJZgnDM4ydoLmyJKbST8GdTTnAfxiAgciKsGF-S-r_B-omqrmSwN9YkIeaXP9BrAhh19ED00HqEwPaiqbJjERW6AB0dmnxX5BYQDVL9d-KBoEFx1HYna9-QnChgWsXtQs_E1F8r9Hxc-VCB3rO6OUkK1OuZi8wo2XDuZU",
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

        // getAccesToken() {
        //   var client_id = "765aa00f1cda4106aa074dfd90472fd8";
        //   var redirect_uri = "http://dashboard.test/dashboard/spotify/redirect-uri";
        //   var scopes = 'user-read-private user-read-email';
        //   const url = 'https://accounts.spotify.com/authorize' +
        //     '?response_type=code' +
        //     '&client_id=' + client_id +
        //     (scopes ? '&scope=' + encodeURIComponent(scopes) : '') +
        //     '&redirect_uri=' + encodeURIComponent(redirect_uri);
        //
        //   axios
        //   .get(url)
        //   .then(response => (console.log(response)))
        //
        // }

     },
}
</script>
