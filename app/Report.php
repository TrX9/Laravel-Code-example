<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'visitDate', 'companyName', 'companyAddress', 'contactName', 'mobileNumber', 'emailAddress', 'contactType', 'reasonFirstTime', 'reasonBOQ', 'reasonBidSubmit',
        'reasonFollowup', 'reasonInstallation', 'reasonPreview', 'reasonBill', 'reasonCollect', 'siteType', 'Notes'
    ];
}