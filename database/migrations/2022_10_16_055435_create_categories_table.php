<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
                    'name' => 'Perkantoran',
                ],
                [
                    'name' => 'Pendidikan',
                ],
                [
                    'name' => 'Kesehatan',
                ],
                [
                    'name' => 'Ibadah',
                ],
                [
                    'name' => 'Wisata',
                ],
                [
                    'name' => 'Olahraga'
                ],
                [
                    'name' => 'Komunikasi'
                ],
                [
                    'name' => 'Transmisi/Instalasi Listrik/Gas/Air Bersih'
                ],
                [
                    'name' => 'Transportasi'
                ],
                [
                    'name' => 'Pabrik'
                ],
                [
                    'name' => 'Landmark'
                ]
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
