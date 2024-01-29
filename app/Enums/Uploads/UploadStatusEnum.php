<?php

namespace App\Enums\Uploads;

enum UploadStatusEnum: string
{
    case PENDING = 'Pending';
    case APPROVED = 'Approved';
    case REJECTED = 'Rejected';
}