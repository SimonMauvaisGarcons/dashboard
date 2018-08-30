<template>
  <div class="add-evenement modal fade" id="updateevent">
      <div class="modal-dialog">
          <div class="modal-content">
            <form v-on:submit.prevent="updateEvent" class="modal-body">
                <notification v-if="show_notification" :informations="notifications_data"></notification>
                <div>
                    Titre de l'événement
                    <input class="form-control" type="text" v-model="toupdate.titre">
                    <p class="text-danger" v-for="erreur in this.erreurs.name" v-bind:key="erreur">{{ erreur }}</p>
                </div>
                <br>
                <div>
                    Description
                    <textarea class="form-control"  v-model="toupdate.description">Description</textarea>
                    <p class="text-danger" v-for="erreur in this.erreurs.description" v-bind:key="erreur">{{ erreur }}</p>
                </div>
                <br>
                <div>
                    Date
                    <input class="form-control"  type="date" v-model="toupdate.date">
                    <p class="text-danger" v-for="erreur in this.erreurs.date" v-bind:key="erreur">{{ erreur }}</p>
                </div>
                <br>
                <div>
                    Type d'événement               
                    <select class="form-control"  v-model="toupdate.type">
                        <option> Fête </option>
                        <option> Soupé </option>
                        <option> Autre </option>
                    </select>
                     <p class="text-danger" v-for="erreur in this.erreurs.type" v-bind:key="erreur">{{ erreur }}</p>
                </div>
                <br>    
                <input type="hidden" v-model="toupdate.id_event">
                <input  class="btn btn-primary" type="submit" value="Mettre à jour">
            </form>
          </div>
      </div>
  </div>
</template>

<script>
    import axios from 'axios';
    import notification from '../Notification';
    export default {
        props: {
            toupdate: {},
        },
        components: {
            notification,
        },
        data() {
            return {
                erreurs: [],
                show_notification: false,
                notifications_data: {
                    message: "",
                    type: "",
                }
            };
        },

        created() {
            
        },


        methods: {
            updateEvent() {

            axios
            .post("/evenement/update",{
                name: this.toupdate.titre,
                description: this.toupdate.description,
                date: this.toupdate.date,
                type: this.toupdate.type,
                id_event: this.toupdate.id_event,
              } 
            )
          	.then((response) => {
                if(response.data.errors){
                    this.erreurs = response.data.errors;
                }else{
                    this.erreurs = [];
                    this.notifications_data.message = "L'événement a bien été modifié";
                    this.notifications_data.type = "alert-success";
                    this.show_notification = true;

                    
                    this.toupdate.time = this.$parent.gettime(response.data.date);

                    const self = this;
                        setTimeout(function(){
                            self.show_notification = false;
                        }, 2000);
                    }
            })
            },
    
        },
  }
</script>
