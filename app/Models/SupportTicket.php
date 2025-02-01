<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_no',
        'customer_name',
        'problem_description',
        'email',
        'phone_number',
        'status',
        'isView',
    ];

    public static function checkByRef($RefNo)
    {
        $data = DB::table('support_tickets AS master')
            ->leftJoin('replies AS child', 'master.id', '=', 'child.support_ticket')
            ->select('*')
            ->where('master.ref_no', '=', $RefNo)
            ->get();
        return $data;
    }
}
