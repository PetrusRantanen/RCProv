<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create computer images table
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('filename_on_server');
            $table->string('filename_extension');
            $table->string('sha256');
            $table->string('uncompressed_sha256')->nullable();
            $table->bigInteger('uncompressed_size')->nullable();
            $table->timestamps();
        });

        // Create computer scripts table
        Schema::create('scripts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->enum('script_type', ['postinstall', 'preinstall']);
            $table->boolean('bg');
            $table->integer('priority')->default(100);
            $table->text('script');
            $table->timestamps();
        });

        // Create computer labels table
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->enum('printer_type', ['ftp', 'command']);
            $table->string('print_command')->nullable();
            $table->string('ftp_hostname')->nullable();
            $table->string('ftp_username')->nullable();
            $table->string('ftp_password')->nullable();
            $table->string('file_extension');
            $table->text('template');
            $table->timestamps();
        });

        // Create computer projects table
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->enum('device', ['cm4']);
            $table->string('storage');
            $table->foreignId('image_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('label_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->enum('label_moment', ['never', 'preinstall', 'postinstall']);
            $table->string('eeprom_firmware')->nullable();
            $table->text('eeprom_settings')->nullable();
            $table->boolean('verify')->default(false);
            $table->timestamps();
        });

        // Create pivot table for projects and scripts
        Schema::create('project_script', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('script_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });

        // Create computer modules table
        Schema::create('cms', function (Blueprint $table) {
            $table->id();
            $table->string('serial')->unique();
            $table->string('mac');
            $table->string('model')->nullable();
            $table->integer('memory_in_gb')->nullable();
            $table->integer('storage')->nullable();
            $table->string('cid')->nullable();
            $table->string('csd')->nullable();
            $table->string('firmware')->nullable();
            $table->string('image_filename')->nullable();
            $table->string('image_sha256')->nullable();
            $table->string('pre_script_output')->nullable();
            $table->string('post_script_output')->nullable();
            $table->integer('script_return_code')->nullable();
            $table->string('temp1')->nullable();
            $table->string('temp2')->nullable();
            $table->foreignId('project_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('provisioning_board')->nullable();
            $table->timestamp('provisioning_started_at')->nullable();
            $table->timestamp('provisioning_complete_at')->nullable();
            $table->timestamps();
            $table->index('provisioning_started_at');
        });

        // Create computer module logs table
        Schema::create('cmlogs', function (Blueprint $table) {
            $table->id();
            $table->string('cm');
            $table->string('board')->nullable();
            $table->string('ip')->nullable();
            $table->enum('loglevel', ['info', 'warning', 'error', 'debug']);
            $table->text('msg');
            $table->timestamps();
            $table->index('cm');
        });

        // Create settings table
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key');
            $table->string('value');
            $table->primary('key');
        });

        // Create hosts table
        Schema::create('hosts', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->unique();
            $table->string('mac')->unique();
            $table->string('hostname')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hosts');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('cmlogs');
        Schema::dropIfExists('cms');
        Schema::dropIfExists('project_script');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('labels');
        Schema::dropIfExists('scripts');
        Schema::dropIfExists('images');
    }
};
