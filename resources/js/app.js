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
      },
      computed: {
        total() {
          let total = 0;
          for (let i = 0; i < this.cart.length; i++) {
            total += parseFloat(this.cart[i].plate_price);
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

      },
  });
}

document.addEventListener("DOMContentLoaded", init);
