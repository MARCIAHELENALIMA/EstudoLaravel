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
        if (!Schema::hasColumn('core_types', 'id')) {
            Schema::create('core_types', function (Blueprint $table) {
                $table->id();
                $table->integer('core_type_ref_id')->nullable();
                $table->string('name', 255);
                $table->string('property_1', 255)->nullable();
                $table->string('property_2', 255)->nullable();
                $table->string('property_3', 255)->nullable();
                $table->string('property_4', 255)->nullable();
                $table->string('property_5', 255)->nullable();
                $table->string('property_6', 255)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->integer('core_type_status_id');
            });
        }

        if (!Schema::hasColumn('users', 'id')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255);
                $table->string('email', 255);
                $table->timestamp('email_verified_at');
                $table->string('password', 255);
                $table->text('two_factor_secret')->nullable();
                $table->text('two_factor_recovery_codes')->nullable();
                $table->timestamp('two_factor_confirmed_at')->nullable();
                $table->string('remember_token', 100)->nullable();
                $table->bigInteger('current_team_id')->nullable();
                $table->string('profile_photo_path', 2048)->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasColumn('user_infos', 'id')) {
            Schema::create('user_infos', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->unsignedBigInteger('user_indication_id')->nullable();
                $table->foreign('user_indication_id')->references('id')->on('users');
                $table->integer('phone')->nullable();
                $table->string('photo', 255)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        // if (!Schema::hasColumn('logs', 'id')) {
        //     Schema::create('logs', function (Blueprint $table) {
        //         $table->id();
        //         $table->unsignedBigInteger('user_id');
        //         $table->foreign('user_id')->references('id')->on('users');
        //         $table->string('loggable_type', 100)->nullable();
        //         $table->string('loggable_id')->nullable();
        //         $table->string('operation', 10)->nullable();
        //         $table->json('data')->nullable();
        //         $table->json('properties_json')->nullable();
        //         $table->timestamps();
        //         $table->softDeletes();
        //         $table->unsignedBigInteger('core_type_status_id');
        //         $table->foreign('core_type_status_id')->references('id')->on('core_types');
        //     });
        // }

        if (!Schema::hasColumn('countries', 'id')) {
            Schema::create('countries', function (Blueprint $table) {
                $table->id();
                $table->string('name', 255)->nullable();
                $table->string('country_code', 3)->nullable();
                $table->string('flag')->nullable();
                $table->string('continent', 50)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('states', 'id')) {
            Schema::create('states', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('country_id');
                $table->foreign('country_id')->references('id')->on('countries');
                $table->string('name', 255)->nullable();
                $table->string('uf', 2)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('cities', 'id')) {
            Schema::create('cities', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('state_id');
                $table->foreign('state_id')->references('id')->on('states');
                $table->double('latitude')->nullable();
                $table->double('longitude')->nullable();
                $table->string('name', 255)->nullable();
                $table->integer('capital_fl')->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('sessions', 'id')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload')->nullable();
                $table->integer('last_activity')->nullable();
            });
        }

        if (!Schema::hasColumn('personal_access_tokens', 'id')) {
            Schema::create('personal_access_tokens', function (Blueprint $table) {
                $table->id();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->longText('payload')->nullable();
                $table->integer('last_activity')->nullable();
            });
        }

        if (!Schema::hasColumn('failed_jobs', 'id')) {
            Schema::create('failed_jobs', function (Blueprint $table) {
                $table->id();
                $table->string('uuid', 255)->nullable();
                $table->text('connection')->nullable();
                $table->text('queue')->nullable();
                $table->longText('payload')->nullable();
                $table->longText('exception')->nullable();
                $table->timestamp('failed_at')->nullable();
            });
        }

        if (!Schema::hasColumn('migrations', 'id')) {
            Schema::create('migrations', function (Blueprint $table) {
                $table->id();
                $table->string('migrations', 255)->nullable();
                $table->integer('batch')->nullable();
            });
        }

        if (!Schema::hasColumn('media', 'id')) {
            Schema::create('media', function (Blueprint $table) {
                $table->id();
                $table->string('disk', 32)->nullable();
                $table->string('directory', 255)->nullable();
                $table->string('filename', 255)->nullable();
                $table->string('extension', 32)->nullable();
                $table->string('mime_type', 128)->nullable();
                $table->string('aggregate_type', 32)->nullable();
                $table->integer('size')->nullable();
                $table->string('variant_name', 255)->nullable();
                $table->integer('original_media')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->string('mediacol', 45)->nullable();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('mediable', 'id')) {
            Schema::create('mediable', function (Blueprint $table) {
                $table->unsignedBigInteger('media_id');
                $table->foreign('media_id')->references('id')->on('media');
                $table->string('mediable_type', 255)->nullable();
                $table->integer('mediable_id')->nullable();
                $table->string('tag')->nullable();
                $table->integer('order')->nullable();
            });
        }

        if (!Schema::hasColumn('profile_socials', 'id')) {
            Schema::create('profile_socials', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('influencer_id')->nullable();
                $table->foreign('influencer_id')->references('id')->on('influencers');
                $table->unsignedBigInteger('company_id')->nullable();
                $table->foreign('company_id')->references('id')->on('companies');
                $table->unsignedBigInteger('agency_id')->nullable();
                $table->foreign('agency_id')->references('id')->on('agencies');
                $table->string('twitter', 450)->nullable();
                $table->string('facebook', 450)->nullable();
                $table->string('instagram', 450)->nullable();
                $table->string('youtube', 450)->nullable();
                $table->string('tiktok', 450)->nullable();
                $table->string('linkedin', 450)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('companies', 'id')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('email', 255)->nullable();
                $table->string('password', 255)->nullable();
                $table->string('name', 255)->nullable();
                $table->string('document', 255)->nullable();
                $table->text('description', 255)->nullable();
                $table->string('photo', 450)->nullable();
                $table->string('photo_document_1', 255)->nullable();
                $table->string('photo_document_2', 255)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('influencers', 'id')) {
            Schema::create('influencers', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('email', 255)->nullable();
                $table->string('password', 255)->nullable();
                $table->string('name', 255)->nullable();
                $table->string('document', 255)->nullable();
                $table->text('description', 255)->nullable();
                $table->string('photo', 450)->nullable();
                $table->string('photo_document_1', 255)->nullable();
                $table->string('photo_document_2', 255)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('agencies', 'id')) {
            Schema::create('agencies', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('email', 255)->nullable();
                $table->string('password', 255)->nullable();
                $table->string('name', 255)->nullable();
                $table->string('document', 255)->nullable();
                $table->text('description', 255)->nullable();
                $table->string('photo', 450)->nullable();
                $table->string('photo_document_1', 255)->nullable();
                $table->string('photo_document_2', 255)->nullable();
                $table->string('photo_document_3', 255)->nullable();
                $table->string('photo_document_4', 255)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('link_tags', 'id')) {
            Schema::create('link_tags', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('influencer_id')->nullable();
                $table->foreign('influencer_id')->references('id')->on('influencers');
                $table->unsignedBigInteger('company_id')->nullable();
                $table->foreign('company_id')->references('id')->on('companies');
                $table->unsignedBigInteger('agency_id')->nullable();
                $table->foreign('agency_id')->references('id')->on('agencies');
                $table->unsignedBigInteger('job_id')->nullable();
                $table->foreign('job_id')->references('id')->on('jobs');
                $table->unsignedBigInteger('core_type_tag_id');
                $table->foreign('core_type_tag_id')->references('id')->on('core_types');
                $table->unsignedBigInteger('tag_id');
                $table->foreign('tag_id')->references('id')->on('tags');
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('tags', 'id')) {
            Schema::create('tags', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('core_type_id');
                $table->foreign('core_type_id')->references('id')->on('core_types');
                $table->string('tag', 450)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('tickets', 'id')) {
            Schema::create('tickets', function (Blueprint $table) {
                $table->id();
                $table->integer('ticket_ref_id')->nullable();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->unsignedBigInteger('influencer_id')->nullable();
                $table->foreign('influencer_id')->references('id')->on('influencers');
                $table->unsignedBigInteger('company_id')->nullable();
                $table->foreign('company_id')->references('id')->on('companies');
                $table->unsignedBigInteger('agency_id')->nullable();
                $table->foreign('agency_id')->references('id')->on('agencies');
                $table->unsignedBigInteger('core_type_id');
                $table->foreign('core_type_id')->references('id')->on('core_types');
                $table->unsignedBigInteger('core_type_progress_id');
                $table->foreign('core_type_progress_id')->references('id')->on('core_types');
                $table->string('protocol', 45)->nullable();
                $table->string('name', 255)->nullable();
                $table->string('description', 255)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('profile_invites', 'id')) {
            Schema::create('profile_invites', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_origin_id');
                $table->foreign('user_origin_id')->references('id')->on('users');
                $table->unsignedBigInteger('user_destiny_id');
                $table->foreign('user_destiny_id')->references('id')->on('users');
                $table->unsignedBigInteger('core_type_id');
                $table->foreign('core_type_id')->references('id')->on('core_types');
                $table->unsignedBigInteger('core_type_progress_id');
                $table->foreign('core_type_progress_id')->references('id')->on('core_types');
                $table->unsignedBigInteger('influencer_id')->nullable();
                $table->foreign('influencer_id')->references('id')->on('influencers');
                $table->unsignedBigInteger('company_id')->nullable();
                $table->foreign('company_id')->references('id')->on('companies');
                $table->unsignedBigInteger('agency_id')->nullable();
                $table->foreign('agency_id')->references('id')->on('agencies');
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('faqs', 'id')) {
            Schema::create('faqs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('core_type_id');
                $table->foreign('core_type_id')->references('id')->on('core_types');
                $table->string('name', 255)->nullable();
                $table->text('description', 255)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('reports', 'id')) {
            Schema::create('reports', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('core_type_id');
                $table->foreign('core_type_id')->references('id')->on('core_types');
                $table->unsignedBigInteger('influencer_origin_id')->nullable();
                $table->foreign('influencer_origin_id')->references('id')->on('influencers');
                $table->unsignedBigInteger('company_origin_id')->nullable();
                $table->foreign('company_origin_id')->references('id')->on('companies');
                $table->unsignedBigInteger('agency_origin_id')->nullable();
                $table->foreign('agency_origin_id')->references('id')->on('agencies');
                $table->unsignedBigInteger('influencer_destiny_id')->nullable();
                $table->foreign('influencer_destiny_id')->references('id')->on('influencers');
                $table->unsignedBigInteger('company_destiny_id')->nullable();
                $table->foreign('company_destiny_id')->references('id')->on('companies');
                $table->unsignedBigInteger('agency_destiny_id')->nullable();
                $table->foreign('agency_destiny_id')->references('id')->on('agencies');
                $table->string('name', 450)->nullable();
                $table->string('description', 450)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }


        if (!Schema::hasColumn('pages', 'id')) {
            Schema::create('pages', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users');
                $table->unsignedBigInteger('influencer_id')->nullable();
                $table->foreign('influencer_id')->references('id')->on('influencers');
                $table->unsignedBigInteger('company_id')->nullable();
                $table->foreign('company_id')->references('id')->on('companies');
                $table->unsignedBigInteger('agency_id')->nullable();
                $table->foreign('agency_id')->references('id')->on('agencies');
                $table->unsignedBigInteger('core_type_id');
                $table->foreign('core_type_id')->references('id')->on('core_types');
                $table->string('name', 255)->nullable();
                $table->string('slug', 450)->nullable();
                $table->string('icon', 450)->nullable();
                $table->string('summary', 450)->nullable();
                $table->longText('content')->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasColumn('job_applications', 'id')) {
            Schema::create('job_applications', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('influencer_id')->nullable();
                $table->foreign('influencer_id')->references('id')->on('influencers');
                $table->unsignedBigInteger('company_id')->nullable();
                $table->foreign('company_id')->references('id')->on('companies');
                $table->unsignedBigInteger('agency_id')->nullable();
                $table->foreign('agency_id')->references('id')->on('agencies');
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->unsignedBigInteger('core_type_progress_id');
                $table->foreign('core_type_progress_id')->references('id')->on('core_types');
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasTable('payments', 'id')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_origin_id');
                $table->foreign('user_origin_id')->references('id')->on('users');
                $table->unsignedBigInteger('user_destiny_id');
                $table->foreign('user_destiny_id')->references('id')->on('users');
                $table->unsignedBigInteger('job_id')->nullable();
                $table->foreign('job_id')->references('id')->on('jobs');
                $table->unsignedBigInteger('job_application_id')->nullable();
                $table->foreign('job_application_id')->references('id')->on('jobs');
                $table->unsignedBigInteger('core_type_id');
                $table->foreign('core_type_id')->references('id')->on('core_types');
                $table->unsignedBigInteger('core_type_progress_id');
                $table->foreign('core_type_progress_id')->references('id')->on('core_types');
                $table->decimal('price_start', 10, 4)->nullable();
                $table->decimal('price_end', 10, 4)->nullable();
                $table->decimal('price_subtotal', 10, 4)->nullable();
                $table->integer('comission_system_base')->nullable();
                $table->timestamp('check_gateway_at')->nullable();
                $table->timestamp('check_prices_at')->nullable();
                $table->string('mp_link_payment', 450)->nullable();
                $table->string('mp_reference', 450)->nullable();
                $table->string('mp_collector_id', 45)->nullable();
                $table->string('mp_preapproval_id', 45)->nullable();
                $table->string('mp_payment_id', 45)->nullable();
                $table->longText('mp_json')->nullable();
                $table->json('transaction_json')->nullable();
                $table->decimal('comission_system', 10, 4)->nullable();
                $table->decimal('comission_gateway', 10, 4)->nullable();
                $table->text('comment')->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->timestamp('approved_at')->nullable();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasTable('jobs', 'id')) {
            Schema::create('jobs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->unsignedBigInteger('company_id')->nullable();
                $table->foreign('company_id')->references('id')->on('companies');
                $table->unsignedBigInteger('agency_id')->nullable();
                $table->foreign('agency_id')->references('id')->on('agencies');
                $table->string('name', 255)->nullable();
                $table->text('description')->nullable();
                $table->decimal('price_start', 10, 4)->nullable();
                $table->decimal('price_end', 10, 4)->nullable();
                $table->decimal('price_free_system', 10, 4)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasTable('notifications', 'id')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->string('slug', 255)->nullable();
                $table->string('name', 450)->nullable();
                $table->text('description')->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }

        if (!Schema::hasTable('certificates', 'id')) {
            Schema::create('certificates', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('influencer_id')->nullable();
                $table->foreign('influencer_id')->references('id')->on('influencer');
                $table->unsignedBigInteger('company_id')->nullable();
                $table->foreign('company_id')->references('id')->on('companies');
                $table->unsignedBigInteger('agency_id')->nullable();
                $table->foreign('agency_id')->references('id')->on('agencies');
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');
                $table->unsignedBigInteger('core_type_progress_id');
                $table->foreign('core_type_progress_id')->references('id')->on('core_types');
                $table->string('token', 450)->nullable();
                $table->string('photo_document_1', 450)->nullable();
                $table->string('photo_document_2', 450)->nullable();
                $table->json('properties_json')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedBigInteger('core_type_status_id');
                $table->foreign('core_type_status_id')->references('id')->on('core_types');
            });
        }
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 
    }
};
