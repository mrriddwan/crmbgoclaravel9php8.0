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
        Schema::create('to_dos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->date('todo_created');
            $table->date('todo_deadline')->nullable();
            $table->string('remark');
            $table->unsignedBigInteger('contact_id')->nullable()->constrained();
            $table->unsignedBigInteger('user_id')->nullable()->constrained();
            $table->unsignedBigInteger('task_id')->nullable()->constrained();
            $table->unsignedBigInteger('status_id')->nullable()->constrained();
            $table->unsignedBigInteger('type_id')->nullable()->constrained();
            $table->unsignedBigInteger('priority_id')->nullable()->constrained();
            $table->unsignedBigInteger('color_id')->nullable()->constrained();

            $table->foreign('contact_id')
                ->references('id')
                ->on('contacts')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('task_id')
                ->references('id')
                ->on('tasks')
                ->onDelete('cascade');

            $table->foreign('status_id')
                ->references('id')
                ->on('contact_statuses')
                ->onDelete('cascade');

            $table->foreign('type_id')
                ->references('id')
                ->on('contact_types')
                ->onDelete('cascade');

            $table->foreign('priority_id')
                ->references('id')
                ->on('priorities')
                ->onDelete('cascade');

            $table->foreign('color_id')
                ->references('id')
                ->on('text_colors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('to_dos');
    }
};
