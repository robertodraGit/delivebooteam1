<div id="search-bar">
  <input class="search" type="text" placeholder="Piatti, ristoranti o tipi di cucina" v-on:keyup.enter="startResearch($event.target.value)" v-model="searchInput">
  <div class="results" v-if="result_tendina">

    <div class="category" v-if="!no_result && !research_error && research_category">
      <p>Categorie</p>
      <div class="category_result">
        <i class="fas fa-search"></i>
        <span>@{{oldSearchInput}}</span>
        <span>(@{{search_typologies_result.length}})</span>
      </div>
    </div>

    <div class="restaurants" v-if="!no_result && !research_error && research_restaurants">
      <p>Ristoranti</p>
      <div v-for="restaurant in search_rest_name_result" class="rest_result">

        <div class="img" :style="{'background-image':'url(' + '/storage/restaurant_icon/' + restaurant.photo + ')'}">

        </div>

        <div class="description">
          <h1 class="rest_name">@{{restaurant.name}}</h1>
          <i class="far fa-star"></i>
          <span class="average_rate">@{{restaurant.average_rate}}</span>
          <span class="rate_number">(@{{restaurant.rate_number}})</span>
        </div>

      </div>
    </div>

    <div class="plates" v-if="!no_result && !research_error && research_plates">
      <p>Piatti</p>
    
      </div>

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
