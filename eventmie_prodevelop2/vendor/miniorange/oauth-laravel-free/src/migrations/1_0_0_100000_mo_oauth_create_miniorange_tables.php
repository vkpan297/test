<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoOauthCreateMiniorangeTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(isset($_SERVER['HTTP_HOST'])){
            if( !Schema::hasTable('mo_oauth_config') ) {
                Schema::create('mo_oauth_config', function (Blueprint $table) {
                    $table->id()->unique()->startingValue(1);
                    $table->text('mo_oauth_domain_name', 100)->nullable();
                    $table->text('mo_oauth_host_name', 100)->nullable();
                    $table->text('mo_oauth_provider_config', 100)->nullable();
                    $table->text('oauth_provider_name', 100)->nullable();
                    $table->text('redirect_uri', 100)->nullable();
                    $table->text('client_id', 100)->nullable();
                    $table->text('client_secret', 100)->nullable();
                    $table->text('scope', 100)->nullable();
                    $table->text('authorize_url', 300)->nullable();
                    $table->text('access_token_url', 300)->nullable();
                    $table->text('resource_owner_details_url', 300)->nullable();
                    $table->text('domain', 300)->nullable();
                    $table->text('realm', 300)->nullable();
                    $table->text('tenant', 300)->nullable();
                    $table->text('policy', 300)->nullable();
                    $table->text('send_header', 300)->nullable();
                    $table->text('send_body', 300)->nullable();
                    $table->text('send_state', 300)->nullable();
                    $table->text('login_attribute', 300)->nullable();
                    $table->text('mo_oauth_message', 300)->nullable();
                });
            }
            
            if( !Schema::hasTable('mo_oauth_admin') ) {
                Schema::create('mo_oauth_admin', function (Blueprint $table) {
                    $table->id()->unique()->startingValue(1);
                    $table->text('mo_oauth_domain_name', 100)->nullable();
                    $table->text('email', 100)->nullable();
                    $table->text('password', 100)->nullable();
                });
            }
    
            if( !Schema::hasTable('mo_oauth_customer_details') ) {
                Schema::create('mo_oauth_customer_details', function (Blueprint $table) {
                    $table->id()->unique()->startingValue(1);
                    $table->text('mo_oauth_domain_name', 100)->nullable();
                    $table->text('mo_oauth_admin_email', 100)->nullable();
                    $table->text('mo_oauth_admin_password', 255)->nullable();
                    $table->text('mo_oauth_admin_customer_key', 100)->nullable();
                    $table->text('mo_oauth_admin_api_key', 100)->nullable();
                    $table->text('mo_oauth_customer_token', 100)->nullable();
                    $table->text('mo_oauth_free_version', 255)->nullable();
                    $table->text('mo_oauth_registration_status', 100)->nullable();
                    $table->text('vl_check_t', 100)->nullable();
                    $table->text('sml_lk', 100)->nullable();
                    $table->text('mo_oauth_message', 100)->nullable();
                    $table->text('mo_oauth_use_case', 300)->nullable();
                    $table->text('mo_oauth_new_registration', 10)->nullable();
                    $table->text('mo_oauth_admin_phone', 20)->nullable();
                    $table->text('mo_oauth_verify_customer', 10)->nullable();
                    $table->text('mo_oauth_transactionId', 255)->nullable();
                    $table->text('mo_oauth_guest_enabled', 10)->nullable();
                    $table->text('site_ck_l', 100)->nullable();
                    $table->text('t_site_status', 100)->nullable();
                });
            }
    
            $tables = [
                'mo_oauth_config',
                'mo_oauth_admin',
                'mo_oauth_customer_details'
            ];
            foreach ($tables as $table) {
                DB::statement('ALTER TABLE ' . $table . ' ENGINE = InnoDB');
            }
            $domain_name = $this->oauth_get_current_domain();
            DB::statement("INSERT INTO mo_oauth_config(mo_oauth_domain_name,mo_oauth_host_name) VALUES('".$domain_name."','https://login.xecurify.com/')");
            DB::insert("INSERT INTO mo_oauth_admin(mo_oauth_domain_name) VALUES('".$domain_name."')");
            DB::insert("INSERT INTO mo_oauth_customer_details(mo_oauth_domain_name) VALUES('".$domain_name."')");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // public function down()
    // {
    //     Schema::dropIfExists('mo_oauth_config');
    //     Schema::dropIfExists('mo_oauth_admin');
    //     Schema::dropIfExists(('mo_oauth_customer_details'));
    // }

    function oauth_get_current_domain()
    {
        $http_host = $_SERVER['HTTP_HOST'];
        if (substr($http_host, -1) == '/') {
            $http_host = substr($http_host, 0, -1);
        }
        $request_uri = $_SERVER['REQUEST_URI'];
        if (substr($request_uri, 0, 1) == '/') {
            $request_uri = substr($request_uri, 1);
        }

        $is_https = (isset($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') == 0);
        $relay_state = 'http' . ($is_https ? 's' : '') . '://' . $http_host;
        return $relay_state;
    }
}