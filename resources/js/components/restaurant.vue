<template>
  <div class="restaurant_container">
    <a :href="restaurantShow">
      <section class="img" :style="{'background-image':'url(' + url_img +')'}">

      </section>

      <section class="description">
        <p>{{average_rate}}({{feedback_number}})</p>
        <h2 class="title">{{name}}</h2>
        <p>{{typologies_string}}</p>
        <p>Consegna: {{delivery_cost/100}}€</p>
      </section>
    </a>
  </div>
</template>

<script>
    export default {
        mounted() {
            // console.log('restaurant mounted.')
            console.log('componente restaurant:', this.restaurant_data);
        },

        data: function() {
         return {
            'id': this.restaurant_data.id,
            'name': this.restaurant_data.name,
            'address': this.restaurant_data.address,
            'phone': this.restaurant_data.phone,
            'description': this.restaurant_data.description,
            'photo': this.restaurant_data.photo,
            'delivery_cost': this.restaurant_data.delivery_cost,
            'average_rate': this.restaurant_data.average_rate,
            'typologies_raw':this.restaurant_data.typologies
          };
        },

        computed: {
          url_img: function() {
            return '/storage/restaurant_icon/' + this.photo;
          },

          restaurantShow: function(){
            return '/restaurant/' + this.id;
          },

          typologies_string: function(){
            let typologies = "";
            this.typologies_raw.forEach((typology, i) => {
              typologies += typology.typology + ', ';
            });
            typologies = typologies.slice(0, -2);
            typologies += '.';

            return typologies;
          },

          feedback_number: function(){
            return this.restaurant_data.feedback.length;
          }

        },

        props: {
          restaurant_data: Object
        },
    }
</script>
