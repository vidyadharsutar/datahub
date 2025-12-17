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
        Schema::connection('mongodb')->create('completedata', function ($collection) {
            $collection->date('date')->nullable();
            $collection->objectId('user_id'); 
            $collection->string('salutation')->nullable();
            $collection->string('first_name')->nullable();
            $collection->string('middle_name')->nullable();
            $collection->string('last_name')->nullable();
            $collection->string('full_name')->nullable();
            $collection->string('email')->nullable();
            $collection->string('domain')->nullable();
            $collection->string('company_name')->nullable();
            $collection->string('employee_size')->nullable();
            $collection->string('see_all_employee_size')->nullable();
            $collection->string('job_title')->nullable();
            $collection->string('industry')->nullable();
            $collection->string('phone')->nullable();
            $collection->string('address')->nullable();
            $collection->string('city')->nullable();
            $collection->string('state')->nullable();
            $collection->string('zip_code')->nullable();
            $collection->string('country')->nullable();
            $collection->string('role')->nullable();
            $collection->string('department')->nullable();
            $collection->string('revenue')->nullable();
            $collection->string('ip')->nullable();
            $collection->string('ip_link')->nullable();
            $collection->string('jt_link')->nullable();
            $collection->string('company_link')->nullable();
            $collection->string('address_link')->nullable();
            $collection->string('number_link')->nullable();
            $collection->string('revenue_link')->nullable();
            $collection->string('naics_code')->nullable();
            $collection->string('saics_code')->nullable();
            $collection->text('ra_comments')->nullable();
            $collection->text('ra_comments_1')->nullable();
            $collection->string('ra_name')->nullable();
            $collection->string('so_report')->nullable();
            $collection->string('so_email_status')->nullable();
            $collection->string('elv_report')->nullable();
            $collection->string('elv_email_status')->nullable();
            $collection->string('mailchimp_outlook_report')->nullable();
            $collection->string('mailchimp_outlook_email_status')->nullable();
            $collection->string('benchmark_report')->nullable();
            $collection->string('benchmark_status')->nullable();
            $collection->string('briteverify_report')->nullable();
            $collection->string('briteverify_status')->nullable();
            $collection->string('neverbounce_report')->nullable();
            $collection->string('neverbounce_status')->nullable();
            $collection->text('qa_remark_1')->nullable();
            $collection->text('qa_remark_2')->nullable();
            $collection->string('qa_data_status')->nullable();
            $collection->string('quality_analyst')->nullable();
            $collection->string('phone_verification_executive')->nullable();
            $collection->string('pv_status')->nullable();
            $collection->string('post_qualification_analyst')->nullable();
            $collection->text('pqa_remark_1')->nullable();
            $collection->text('pqa_remark_2')->nullable();
            $collection->string('pqa_data_status')->nullable();
            $collection->string('mis_executive')->nullable();
            $collection->text('mis_remarks')->nullable();
            $collection->string('delivery_status')->nullable();
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completedata');
    }
};
