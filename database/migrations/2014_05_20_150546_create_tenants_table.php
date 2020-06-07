<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('plan_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('cnpj')->unique();
            $table->string('name')->unique();
            $table->string('url')->unique();
            $table->string('email')->unique();
            $table->string('logo')->nullable();            

            //Status tenant (se inativar 'N' ele perde o acesso ao sistema)
            $table->enum('active', ['Y', 'N'])->default('Y');
            
            //Subscription
            $table->date('subscription')->nullable(); //Data que se inscreveu
            $table->date('expires_at')->nullable(); //Data que expira o acesso
            $table->string('subscription_id', 255)->nullable(); //Identificado do Gateway de pagamento
            $table->boolean('subscription_active', 255)->default(false); //Assinatura ativa
            $table->boolean('subscription_suspended', 255)->default(false); // Assinatura cancelada
            
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
        Schema::dropIfExists('tenants');
    }
}
