<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });

        DB::table('categories')->insert(
            array(
                [
                    'name' => 'Gereja',
                ],[
                    'name' => 'Masjid',
                ],[
                    'name' => 'Bangunan Administrasi',
                ],[
                    'name' => 'Sekolah',
                ],[
                    'name' => 'PDAM',
                ],[
                    'name' => 'POM Bensin',
                ],[
                    'name' => 'Pabrik',
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
