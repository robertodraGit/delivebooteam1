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
         this.get_all_restaurants();
       })},
      data: {
          restaurants: [],
          cart: [],
          order: [],
          checkout: 0,
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
        get_all_restaurants: function(){
          axios.get('http://localhost:8000/home/getallrestaurant')
                .then(res => {
                  this.restaurants = res.data.restaurants;
                  // console.log(this.restaurants);
                });
        },

        pushInCart: function(plate) {
          this.cart.push(plate);
        },

        reset_cart: function() {
          this.cart = [];
          this.cart_new = [];
        },

        get_cart: function() {
          axios.post('http://localhost:8000/create/order', {
                    cart: this.cart
                  })
                .then(cart => {

                  this.checkout = cart.data.total_cart;

                  for(let i=0; i<cart.data.length; i++) {
                    this.order.push(cart.data[i]);
                  }
                  // window.location.href = 'http://localhost:8000/create/order';
                })
                .catch(error => {
                  console.log(error);
                });
        },
      },
  });
}

document.addEventListener("DOMContentLoaded", init);
