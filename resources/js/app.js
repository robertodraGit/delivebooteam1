const { default: axios } = require('axios');

require('./bootstrap');
window.Vue = require('vue');
const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
function  init() {
  const app = new Vue({
      el: '#app',
      mounted: function () {
       this.$nextTick(function () {
         console.log("App montata!");
         this.getRestaurantsInit();
       })},
      data: {
          restaurants: [],
          cart: [],
          order: [],
          cacca: 100,

          // ricerca
          searchInput: "",
          searchResult: [],

          // flags
          result_tendina: 0,
          no_result: 0,
          research_error: 0,
          research_category: 0,
          research_restaurants: 0,
          research_plates: 0,

      },
      computed: {

        cart_new: function() {

          let cart_order = [];
          this.cart.forEach(element => {

            if(!cart_order.some(plate => plate.plate_id == element.plate_id)) {

              let new_element = element;
              new_element['quantity'] = 1;
              cart_order.push(new_element);

            } else {

              for(let i=0; i<cart_order.length; i++) {

                if(cart_order[i].plate_id == element.plate_id) {

                  cart_order[i].quantity++;

                  cart_order[i].plate_price = parseFloat(cart_order[i].quantity).toFixed(2) *
                  parseFloat(element.plate_price).toFixed(2);

                  cart_order[i].plate_price = cart_order[i].plate_price.toFixed(2);
                }
              }
            }
          });

          return cart_order;
        },

        total: function() {

          let total = 0;
          for (let i = 0; i < this.cart_new.length; i++) {
            total += parseFloat(this.cart_new[i].plate_price);
          }
          return total.toFixed(2);
        },

        search_typologies_result: function(){
          return this.searchResult.typology_resoult;
        },

        search_rest_name_result: function(){
          return this.searchResult.rest_name_resoult;
        },

        search_plate_name_result: function(){
          return this.searchResult.plates_resoult;
        },

      },

      watch: {
        searchInput: function(newVal){
          if (newVal === "") {
            this.research_error = 0;
            this.result_tendina = 0;
          }
        },
      },

      methods: {

        getRestaurantsInit: function(){
          axios.get('/getrestaurantsinit', {
            params: {
            }
            })
            .then((response) => {
              console.log('Primi ristoranti casuali: ', response.data.restaurants);
              this.restaurants = response.data.restaurants;
            })
            .catch(function (error) {
              console.log(error);
            })
        },

        startResearch: function(queries){
          console.log(queries);
          axios.get('/search/' + queries, {
            params: {
            }
            })
            .then((response) => {
              this.searchResult = response.data;

              if (response.data.error) {
                console.log(response.data.error);
                this.research_error = 1;
              } else {

                if (this.searchResult.typology_resoult.length === 0) {
                  this.research_category = 0;
                } else {
                  this.research_category = 1;
                  this.result_tendina = 1;
                }
                if (this.searchResult.rest_name_resoult.length === 0) {
                  this.research_restaurants = 0;
                } else {
                  this.research_restaurants = 1;
                  this.result_tendina = 1;
                }
                if (this.searchResult.plates_resoult.length === 0) {
                  this.research_plates = 0;
                } else {
                  this.research_plates = 1;
                  this.result_tendina = 1;
                }
              }

              console.log('ALL', this.searchResult);
              console.log('T', this.search_typologies_result);
              console.log('R', this.search_rest_name_result);
              console.log('P', this.search_plate_name_result);
            })
            .catch(function (error) {
              console.log(error);
            })
        },

        pushInCart: function(plate) {
          this.cart.push(plate);
        },

        reset_cart: function() {
          this.cart = [];
          this.cart_new = [];
        },



        get_cart: function() {

          axios.post('http://localhost:8000/keep-cart', {
                    cart: this.cart
                  })
                .then(cart => {

                  if (cart.status === 200) {

                    for(let i=0; i<cart.data.length; i++) {
                      this.order.push(cart.data[i]);
                    }
                  window.location='http://localhost:8000/create/order';
                  }

                })
                .catch(error => {
                  console.log(error);
                });
        },

      },
  });
}

document.addEventListener("DOMContentLoaded", init);

// menu hamburger dashboard
// const menu_btn = document.querySelector('.sidebar');
// menu_btn.addEventListener('click', function () {
//     menu_btn.classList.toggle('is-active');
// });
