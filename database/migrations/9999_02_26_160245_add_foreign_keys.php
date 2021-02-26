<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeys extends Migration
{

    public function up()
    {

      Schema::table('plates', function (Blueprint $table) {
        $table  ->foreign('category_id', 'plate_category')
                ->references('id')
                ->on('categories');
      });

      Schema::table('plates', function (Blueprint $table) {
        $table  ->foreign('user_id', 'plate_user')
                ->references('id')
                ->on('users');
      });

      Schema::table('order_plate', function (Blueprint $table) {
        $table  ->foreign('order_id', 'op_order')
                ->references('id')
                ->on('orders');

        $table  ->foreign('plate_id', 'op_plate')
                ->references('id')
                ->on('plates');
      });

      Schema::table('typology_user', function (Blueprint $table) {
        $table  ->foreign('typology_id', 'tu_typology')
                ->references('id')
                ->on('typologies');

        $table  ->foreign('user_id', 'tu_user')
                ->references('id')
                ->on('users');
      });

      Schema::table('payments', function (Blueprint $table) {
        $table  ->foreign('order_id', 'pay_order')
                ->references('id')
                ->on('orders');
      });

      Schema::table('feedback', function (Blueprint $table) {
        $table  ->foreign('user_id', 'fb_user')
                ->references('id')
                ->on('users');
      });
    }

    public function down()
    {
      Schema::table('feedback', function (Blueprint $table) {
        $table ->dropForeign('fb_user');
      });


      Schema::table('payments', function (Blueprint $table) {
        $table ->dropForeign('pay_order');
      });

      Schema::table('typology_user', function (Blueprint $table) {
        $table ->dropForeign('tu_user');
        $table ->dropForeign('tu_typology');
      });

      Schema::table('order_plate', function (Blueprint $table) {
        $table ->dropForeign('op_plate');
        $table ->dropForeign('op_order');
      });

      Schema::table('plates', function (Blueprint $table) {
        $table  ->dropForeign('plate_user');
      });

      Schema::table('plates', function (Blueprint $table) {
        $table ->dropForeign('plate_category');
      });

    }
}
