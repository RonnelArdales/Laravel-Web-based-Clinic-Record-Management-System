<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function setBehavioralObservationAttribute($value)
    {
        $this->attributes['behavioral_observation'] = $value ?: 'n/a';
    }

    public function setBriefSummaryEncounterAttribute($value)
    {
        $this->attributes['brief_summary_encounter'] = $value ?: 'n/a';
    }

    public function setClinicalImpressionAttribute($value)
    {
        $this->attributes['clinical_impression'] = $value ?: 'n/a';
    }

    public function setTreatmentGivenAttribute($value)
    {
        $this->attributes['treatment_given'] = $value ?: 'n/a';
    }

    public function setRecommendationAttribute($value)
    {
        $this->attributes['recommendation'] = $value ?: 'n/a';
    }

    public function user(){
                                            //2nd unique id sa appointment table 
                                                //3rd  unique id sa user table
        return $this->belongsTo(User::class, 'user_id', 'id'); // select * from user where 
    }
}
