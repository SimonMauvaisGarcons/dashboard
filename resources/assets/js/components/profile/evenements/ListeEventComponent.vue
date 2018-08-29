<template>
  <div class="liste-evenement">
      <div v-if="Object.keys(listeevenement).length === 0">
          <p>Ajouter vos événements !</p>
      </div>
      <div v-else>

          <table class="table">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col"><button class="btn btn-link" v-on:click="updateOrder('titre')">Titre</button></th>
                <th scope="col"><button class="btn btn-link" v-on:click="updateOrder('date')">Date</button></th>
                <th scope="col"><button class="btn btn-link" v-on:click="updateOrder('type')">Type</button></th>
                <th scope="col">-</th>
                <th scope="col">-</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(event, index) in listeevenement" :data-id="event.id_event" v-bind:key="event.id">
                    <th scope="row">{{ event.id_event }}</th>
                    <td>{{ event.titre }}</td>
                    <td>{{ event.date }}</td>
                    <td>{{ event.type }}</td>
                    <td><button class="btn btn-link" @click="$parent.updateEvenement(index, event)" data-toggle="modal" data-target="#updateevent">Edit</button></td>
                    <td><button class="btn btn-danger" @click="$parent.deleteEvent(index)">Supprimer</button></td>
                </tr>
            </tbody>
        </table>
      </div>
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
                orderby: '',
            };
        },
        created() {
            
        },
        methods: {
            updateOrder(typeOrder) {

                this.orderby = typeOrder;
                this.sortby();
            },
             /**
             * Return la liste classé par titre
             */
            sortby: function () {
                switch(this.orderby) {
                    case "id":
                        this.listeevenement.sort(dynamicSort("id"));
                        break;
                    case "titre":
                        this.listeevenement.sort(dynamicSort("titre"));
                        break;
                    case "date":
                        this.listeevenement.sort( ( a, b) => {
                            return new Date(a.date) - new Date(b.date);
                        });
                        break;
                    case "type":
                        this.listeevenement.sort(dynamicSort("type"));
    
                    break;
                }
        
            },

        },
    }
    /**
 * Function to sort alphabetically an array of objects by some specific key.
 * 
 * @param {String} property Key of the object to sort.
*/
function dynamicSort(property) {
    var sortOrder = 1;
    if(property[0] === "-") {
        sortOrder = -1;
        property = property.substr(1);
    }
    return function (a,b) {
        if(sortOrder == -1){
            return b[property].localeCompare(a[property]);
        }else{
            return a[property].localeCompare(b[property]);
        }        
    }
}
</script>
