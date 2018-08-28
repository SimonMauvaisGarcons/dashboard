<template>
  <div class="liste-evenement">
      <ul>
          <li v-for="(event, index) in current_liste" :data-id="event.id_event" v-bind:key="event.id">
              <p class="small">  
                  {{ event.titre }} - {{ event.date }} - {{ event.type }}
                  <button class="btn btn-link">Edit</button>
                  <button class="btn btn-danger" @click="deleteEvent(index)">Supprimer</button>
              </p>
          </li>
      </ul>
  </div>
</template>


<script>

    import axios from 'axios';

    export default {
        props: {
            listeevenement: {}
        },
        components: {

        },
        data() {
            return {
                current_liste: this.listeevenement
            };
        },
        created() {
            
        },
        methods: {
            
            deleteEvent(index) {

                const id = event.target.closest("li").getAttribute("data-id");
                const path = "evenement/delete?id="+ id +"";
                this.current_liste.splice(index, 1);

                axios
                .get(path)
                .then((response) => {

                })
                
             }
        },
  }
</script>
