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
          cartArray: [],
          cartTotal: [],
      },
      computed: {
        
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
          this.cartArray.push(plate);
        },

        pushPricesInCart: function(plate) {
          this.cartTotal.push(plate);
        },

        cartSend: function() {
          axios
            .get(this.cartArray)
            .then(response => (this.cartArray = response.data))
            .catch(error => 
              console.log(error));
        },
      },
  });
}
document.addEventListener("DOMContentLoaded", init);