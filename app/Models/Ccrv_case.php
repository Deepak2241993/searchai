<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ccrv_case extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'request_id', 'transaction_id', 'status', 'code', 'message', 'ccrv_status', 'case_number', 'case_category', 'case_type', 'case_status', 'case_year', 'cnr', 'district_name', 'filing_date', 'filing_number', 'filing_year', 'first_hearing_date', 'decision_date', 'court_name', 'oparty', 'police_station', 'under_acts', 'under_sections', 'nature_of_disposal', 'name', 'father_match_type', 'name_match_type', 'algorithm_risk', 'state_name', 'address', 'created_at', 'updated_at', 'registration_number', 'registration_year', 'source', 'type', 'case_decision_date', 'registration_date','token_id'];
}
