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
          cacca: 50,
          searchResult: [],
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
              console.log(response.data);
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
