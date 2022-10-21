<?php

use App\Models\Category;
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
        Schema::create('lokasis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class);
            $table->string('name');
            $table->string('nama_lain');
            $table->string('address');
            $table->string('desa');
            $table->string('bentuk');
            $table->string('ukuran');
            $table->integer('luasan');
            $table->string('strata');
            $table->string('kualitas_unsur');
            $table->string('pemanfaatan_lain')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('sertifikat')->nullable();
            $table->string('keterangan_tambahan')->nullable();
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lokasis');
    }
};
