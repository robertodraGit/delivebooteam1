<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="{{asset('/js/app.js')}}" ></script>
  </head>
  <body>

    <div id="app2">
      <h3>Test research</h3>
      <input type="text" name="" value="" v-model="researchInput">
      <button type="button" name="button" @click="startResearch(researchInput)">GO</button>
      <p>@{{researchInput}}</p>
      <button type="button" name="button" @click="getAllRestByName(researchInput)">Get all rests by name</button>
      <button type="button" name="button" @click="getAllPlateByName(researchInput)">Get all plates by name</button>

    </div>


    <script type="text/javascript">
        function  init() {
          const app = new Vue({
              el: '#app2',
              mounted: function () {
                console.log("Test research avviato");
                  axios.get('/getrestaurantsinit', {
                    params: {
                    }
                    })
                    .then(function (response) {
                      console.log(response.data);
                    })
                    .catch(function (error) {
                      console.log(error);
                    })
              },
              data: {
                researchInput: ""
              },
              computed: {

              },
              methods: {
                startResearch: function(queries){
                  console.log(queries);
                  axios.get('/search/' + queries, {
                    params: {
                    }
                    })
                    .then(function (response) {
                      console.log(response.data);
                    })
                    .catch(function (error) {
                      console.log(error);
                    })
                },

                getAllRestByName: function(queries){
                  console.log(queries);
                  axios.get('/getallrestbyname/' + queries, {
                    params: {
                    }
                    })
                    .then(function (response) {
                      console.log(response.data);
                    })
                    .catch(function (error) {
                      console.log(error);
                    })
                },

                getAllPlateByName: function(queries){
                  console.log(queries);
                  axios.get('/getallplatebyname/' + queries, {
                    params: {
                    }
                    })
                    .then(function (response) {
                      console.log(response.data);
                    })
                    .catch(function (error) {
                      console.log(error);
                    })
                }
              },
          });
        }

        document.addEventListener("DOMContentLoaded", init);
    </script>
  </body>
</html>
