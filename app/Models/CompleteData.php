<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompleteData extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'completedata';

    protected $fillable = [
        'date',
        'user_id',
        'salutation',
        'first_name',
        'middle_name',
        'last_name',
        'full_name',
        'email',
        'domain',
        'company_name',
        'employee_size',
        'see_all_employee_size',
        'job_title',
        'industry',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'role',
        'department',
        'revenue',
        'ip',
        'ip_link',
        'jt_link',
        'company_link',
        'address_link',
        'number_link',
        'revenue_link',
        'naics_code',
        'saics_code',
        'ra_comments',
        'ra_comments_1',
        'ra_name',
        'so_report',
        'so_email_status',
        'elv_report',
        'elv_email_status',
        'mailchimp_outlook_report',
        'mailchimp_outlook_email_status',
        'benchmark_report',
        'benchmark_status',
        'briteverify_report',
        'briteverify_status',
        'neverbounce_report',
        'neverbounce_status',
        'qa_remark_1',
        'qa_remark_2',
        'qa_data_status',
        'quality_analyst',
        'phone_verification_executive',
        'pv_status',
        'post_qualification_analyst',
        'pqa_remark_1',
        'pqa_remark_2',
        'pqa_data_status',
        'mis_executive',
        'mis_remarks',
        'delivery_status'
    ];

    public $timestamps = true;
}
