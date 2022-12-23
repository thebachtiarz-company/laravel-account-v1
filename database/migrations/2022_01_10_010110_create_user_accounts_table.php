<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use TheBachtiarz\Account\Interfaces\Model\UserAccountModelInterface;
use TheBachtiarz\Account\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, UserAccountModelInterface::USER_ACCOUNT_ATTRIBUTE_USERID)->unique()->nullable()->constrained()->nullOnDelete();
            $table->string(UserAccountModelInterface::USER_ACCOUNT_ATTRIBUTE_CODE);
            $table->text(UserAccountModelInterface::USER_ACCOUNT_ATTRIBUTE_DATA);
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
        Schema::dropIfExists('user_accounts');
    }
};
