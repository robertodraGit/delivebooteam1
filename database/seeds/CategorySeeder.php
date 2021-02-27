<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories = [
          'Americano',
          'Asiatico',
          'Ali di pollo',
          'Barbecue',
          'Brasiliano',
          'Burger King',
          'Caffè',
          'Cinese',
          'Colazione',
          'Comfort Food',
          'Crèpe',
          'Curry',
          'Dessert',
          'Dolci e dessert',
          'Fast food',
          'Frappè',
          'Frutti di mare',
          'Gelato',
          'Giapponese',
          'Hamburger',
          'Indiano',
          'Italiano',
          'Kebab',
          'McDonalds',
          'Mediterraneo',
          'Messicano',
          'Pasta',
          'Piadina',
          'Pizza',
          'Poke',
          'Pollo',
          'Sandwich',
          'Spuntini',
          'Sushi',
          'Turco',
        ];

        foreach ($categories as $category) {
          $newCategory = new Category();
          $newCategory ->category = $category;
          $newCategory -> save();
        }
    }
}
