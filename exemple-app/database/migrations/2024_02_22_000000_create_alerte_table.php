<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlerteTable extends Migration
{
    public function up()
    {
        Schema::create('alertes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->date('date');
            $table->string('missing_person');
            $table->timestamps();
    
            $table->foreign('title')->references('title')->on('admin_events');
        });
    }

    public function down()
    {
        Schema::dropIfExists('alertes');
    }
}
?>
