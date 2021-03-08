<div id="search-bar">
  <input class="search" type="text" placeholder="Piatti, ristoranti o tipi di cucina" v-on:keyup.enter="startResearch($event.target.value)" v-model="searchInput">
  <div class="results" v-if="result_tendina">

    <div class="category" v-if="!no_result && !research_error && research_category">
      <p>Categorie</p>

    </div>

    <div class="restaurants" v-if="!no_result && !research_error && research_restaurants">
      <p>Ristoranti</p>

    </div>

    <div class="plates" v-if="!no_result && !research_error && research_plates">
      <p>Piatti</p>

    </div>

    <div class="no-results" v-show="no_result">
      <p>Nessun risultato</p>
    </div>

    <div class="error" v-show="research_error">
      <p>Nessun risultato: prova ad inserire parole più lunghe.</p>
    </div>

    <div class="loading" v-show="loading">
      <p>Ricerca in corso...</p>
    </div>

  </div>
</div>
