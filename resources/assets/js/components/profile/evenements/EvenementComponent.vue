<template>
  <div class="profile-evenement">
    <listeevent v-bind:listeevenement="liste"></listeevent>
    <hr>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addevent">Ajouter un evenement</button>
    <addevent></addevent>
    <updateevent v-bind:toupdate="tobeupdate"></updateevent>
  </div>
</template>

<script>
    import axios from 'axios';  
    import addevent from './AddEventComponent';
    import listeevent from './ListeEventComponent';
    import updateevent from './UpdateComponent';

    export default {
        
        props: {
            liste: {},
        },
        components: {
            addevent,
            listeevent,
            updateevent,
        },
        data() {
            return {
                
                show_notification: false,
                current_liste: this.liste,
                tobeupdate: '',
            };
        },

        
        computed: {
  
        },

        methods: {
            addToListe(event) {
                console.log(event);
                this.current_liste.push({
                    created_at: event.created_at,
                    date: event.date,
                    description: event.description,
                    id: event.id,
                    titre: event.titre,
                    type: event.type,
                    updated_at:event.updated_at,
                    user_id: event.user_id,
                });
            },
            deleteEvent(index) {
                console.log("Delete element")

                const id = event.target.closest("tr").getAttribute("data-id");
                const path = "evenement/delete?id="+ id +"";
                this.current_liste.splice(index, 1);

                axios
                .get(path)
                .then((response) => {

                })
                
            },

            updateEvenement(index, event){
                console.log(event);
                this.tobeupdate = event;
            },  
        },
  }



</script>
