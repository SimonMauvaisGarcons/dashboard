<template>
  <div class="calendrier-component">

    <div class="calendrier-tableau">
        <ul>
          <li v-for="(jour, index) in jours">{{ jour }}</li>
        </ul>
        <ul>
          <li v-for="(jour, index) in nombre_jour" v-bind:class="isCurrentDay(index)">{{ jour }}</li>
        </ul>
    </div>

  </div>
</template>

<script>

import moment from 'moment';

export default {
    props: {
      locale: {
        type: String,
        default: document.documentElement.lang,
      },
    },
    data() {
        return {
          date: new Date(),
          jours: ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"],
          jour_courrant:'',
          nombre_jour: moment().daysInMonth(),
          annee: '',
          moi: '',
          premier_jour: '',
          dernier_jour: '',
        };
    },
    created() {
        this.refreshTime();
        setInterval(this.refreshTime, 1000);
    },
    methods: {

        refreshTime() {
           this.annee = this.date.getFullYear();
           this.moi = this.date.getMonth();
           this.jour_courrant = this.date.getDate();
           this.nombre_jour = moment(""+this.annee+"-"+this.moi+"", "YYYY-MM").daysInMonth(this.moi);
           this.premier_jour = new Date(this.annee, this.moi , 1);
           this.dernier_jour = new Date(this.annee, this.moi + 1, 0);
        },

        /*
        * @return classname si c'est le jour courrant
        * @param index de la boucle
        */
        isCurrentDay(index) {
          /*
          * Valide si c'est le jour courrant
          */
          if ((index + 1) === this.jour_courrant){
            return "courrant";
          }
          else{
            return;
          }
        }

     },
}
</script>
