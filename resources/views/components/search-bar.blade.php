<div id="search-bar">
  <input class="search" type="text" placeholder="Piatti, ristoranti o tipi di cucina" v-on:keyup.enter="startResearch($event.target.value)" v-model="searchInput">
  <div class="results">

    <div class="category" v-if="!no_result && !research_error && research_category">
      <h3>Categorie</h3>

    </div>

    <div class="restaurants" v-if="!no_result && !research_error && research_restaurants">
      <h3>Ristoranti</h3>

    </div>

    <div class="plates" v-if="!no_result && !research_error && research_plates">
      <h3>Piatti</h3>

    </div>

    <div class="no-results" v-show="no_result">
      <p>Nessun risultato</p>
    </div>

    <div class="error" v-show="research_error">
      <p>Nessun risultato: prova ad inserire parole più lunghe.</p>
    </div>

  </div>
</div>
