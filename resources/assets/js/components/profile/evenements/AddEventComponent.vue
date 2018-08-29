<template>
  <div class="add-evenement modal fade" id="addevent">
      <div class="modal-dialog">
          <div class="modal-content" v-if="isadded">
            <form v-on:submit.prevent="addEvent" class="modal-body">
                <div>
                    Titre de l'événement
                    <input class="form-control" type="text" v-model="title">
                    <p class="text-danger" v-for="erreur in this.erreurs.name" v-bind:key="erreur">{{ erreur }}</p>
                </div>
                <br>
                <div>
                    Description
                    <textarea class="form-control"  v-model="description">Description</textarea>
                     <p class="text-danger" v-for="erreur in this.erreurs.description" v-bind:key="erreur">{{ erreur }}</p>
                </div>
                <br>
                <div>
                    Date
                    <input class="form-control"  type="date" v-model="date">
                    <p class="text-danger" v-for="erreur in this.erreurs.date" v-bind:key="erreur">{{ erreur }}</p>
                </div>
                <br>
                <div>
                    Type d'événement               
                    <select class="form-control"  v-model="type">
                        <option> Fête </option>
                        <option> Soupé </option>
                        <option> Autre </option>
                    </select>
                    <p class="text-danger" v-for="erreur in this.erreurs.type" v-bind:key="erreur">{{ erreur }}</p>
                </div>
                <br>    
                <input  class="btn btn-primary" type="submit" value="Ajouter un evenement">
            </form>
          </div>
          <div class="modal-content"  v-else>
              <div class="modal-body">
                <h2>L'événement a bien été ajouté.</h2>
                <button class="btn btn-success" v-on:click="addOtherEvent()" >Ajouter un autre evenement</button>
                <button class="btn btn-link">Cancel</button>
              </div>
          </div>
      </div>

    
  </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: {
            
        },
        components: {
            
        },
        data() {
            return {
                title: "",
                description: "",
                date: "",
                type: "",
                erreurs: "",
                isadded: true,
            };
        },

        created() {
            
        },


        methods: {

          addEvent() {
            axios
            .post("/evenement/add",{
                name: this.title,
                description: this.description,
                date: this.date,
                type: this.type,
              } 
            )
          	.then((response) => {
                if(response.data.errors){
                this.erreurs = response.data.errors;
                }else{
                    this.isadded = false;
                    this.$parent.addToListe(response.data);
                }
            })
          },

          addOtherEvent() {
            this.title = "";
            this.description = "";
            this.date = "";
            this.type = "";
            this.erreurs = "";
            this.isadded = true;
          }
        },
  }
</script>
