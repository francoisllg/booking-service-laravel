<?php

use App\Enums\Accommodation\AccommodationTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $accommodationTypes = AccommodationTypes::getAll();
        Schema::create('accommodations', function (Blueprint $table)use ($accommodationTypes) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name',150);
            $table->enum('type',$accommodationTypes);
            $table->string('city');
            $table->string('address');
            $table->string('country');
            $table->string('postal_code');
            $table->unsignedInteger('max_guests');
            $table->json('distribution');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accommodations');
    }
}
