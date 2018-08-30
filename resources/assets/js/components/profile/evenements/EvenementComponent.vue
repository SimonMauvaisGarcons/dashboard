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

          
        created() {
            const _this = this;
            this.current_liste.map(function(value, key) {
                value.time = _this.gettime(value.date);
            });
        },
        computed: {

        },

        methods: {

            gettime(time){
                let now = new Date();
                now.setHours(0,0,0,0);
                let event_date = new Date(time);

                if (event_date < now) {       
                    return "il y a " + this.diffdate(event_date, now)+ " jour(s)";
                } else {
                    const nbrjours = this.diffdate(event_date, now) * -1;
                    return "Dans" + nbrjours + "jour(s)";
                }
            },
            diffdate(d1,d2){
        
                var WNbJours = d2.getTime() - d1.getTime();
                return Math.ceil(WNbJours/(1000*60*60*24));
            },

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

                this.tobeupdate = event;
            },  
        },
  }






</script>
