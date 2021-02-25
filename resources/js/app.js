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
       })},
  });
}

document.addEventListener("DOMContentLoaded", init);
