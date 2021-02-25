<!-- Da aggiungere:
fatto: se non diponibile,
click: apertura dettagli,
fatto: gestire meglio l'img, specie se non quadrate, magari come background img
cut del testo da vue (ok ma non va da responsive) -->


<template>
  <div class="plate_container">

    <div class="plate_text">
      <h2 class="title">{{nome}}</h2>
      <p class="descrizione">{{descrizione_short}}</p>
      <span :class="['prezzo_intero' ,{'prezzo_barrato': this.sconto > 0}]">{{prezzo_euro}}€</span>
      <span v-if="this.sconto > 0" class="prezzo_scontato">{{prezzo_sconto}}€</span>
    </div>

    <div class="plate_img"
      :style="{'background-image':'url(' + url_img +')'}">
      <span v-if="this.sconto > 0" class="sconto">{{sconto}}%</span>
    </div>

    <div v-if="this.disponibile == 0" class="plate_esaurito">
      <p>Esaurito</p>
    </div>

    <!-- Dettagli al click -->
    <div v-show="display_details" class="plate_detail">

      <section class="header">
        <h2 class="title">{{nome}}</h2>
      </section>

      <section class="show">
        <div class="plate_img" :style="{'background-image':'url(' + url_img +')'}"></div>
        <p class="descrizione">{{descrizione}}</p>
        <p>Ingredienti: <br> {{ingredienti}}</p>

        <div class="quantity_pannel">

          <div class="remove_plate">
            -
          </div>
          <div class="quantity">
            <span>{{ quantity }}</span>
          </div>
          <div class="add_plate">
            +
          </div>

        </div>
      </section>

      <section class="total">
        <div class="button-light cancel">
          <span>Cancella</span>
        </div>

        <div class="button-strong">

        </div>
      </section>

    </div>


    </div>

  </div>
</template>

<script>
    export default {
      data: function() {
       return {
          'nome': this.plate_data.nome,
          'ingredienti': this.plate_data.ingredienti,
          'descrizione': this.plate_data.descrizione,
          'prezzo_cent': this.plate_data.prezzo,
          'sconto': this.plate_data.sconto,
          'disponibile': this.plate_data.disponibile,
          'immagine': this.plate_data.immagine,

          // flags
          'display_details': true,

          //aggiungi al carrello
          'quantity': 1,
        };
      },

      computed: {

        descrizione_short: function(){
          let descrizione = this.descrizione;
          if (descrizione.length > 100) {
            descrizione = descrizione.slice(0,97);
            descrizione += '...';
          }
          console.log(descrizione);
          return descrizione;
        },

        prezzo_euro: function() {
          return (this.prezzo_cent / 100).toFixed(2);
        },

        prezzo_sconto: function() {
          if (this.sconto > 0) {
            let sconto_euro = (this.sconto * this.prezzo_euro / 100).toFixed(2);
            return (this.prezzo_euro - sconto_euro).toFixed(2);
          } else {
            return "Prezzo intero";
          }
        },

        // total_price: function(){
        //
        // }

        url_img: function() {
          return '/storage/plates/' + this.immagine;
        }

      },

      mounted() {
          console.log('Plate mounted');
          console.log('plate_data: ', this.plate_data);
          console.log('nome: ', this.nome);
          console.log('ingredienti: ', this.ingredienti);
          console.log('descrizione: ', this.descrizione);
          console.log('prezzo_cent: ', this.prezzo_cent);
          console.log('sconto: ', this.sconto);
          console.log('disponibile: ', this.disponibile);
          console.log('immagine: ', this.immagine);
      },

      props: {
        plate_data: Object
      },

      watch: {
      },

      methods: {
      },



    }
</script>
