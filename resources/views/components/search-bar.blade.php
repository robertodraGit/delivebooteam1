<div id="search-bar">
  <input class="search" type="text" placeholder="Piatti, ristoranti o tipi di cucina" v-on:keyup.enter="startResearch($event.target.value)">
  <div class="results">

    <div class="category">
      <h3>Categorie</h3>

    </div>

    <div class="restaurants">
      <h3>Ristoranti</h3>

    </div>

    <div class="plates">
      <h3>Piatti</h3>

    </div>

  </div>
</div>
