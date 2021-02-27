<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Plate;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Order::class, 50) -> create()
      -> each(function($order){

          $plates = Plate::inRandomOrder()
          ->limit(rand(1,6)) -> get();

          $order -> plates() -> attach($plates);
      });

    }
}
