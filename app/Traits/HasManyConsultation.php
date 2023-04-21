<?php

namespace App\Traits;

use App\Models\Consultation;

trait HasManyConsultation
{
  function consultation()
  {
    return $this->belongsTo(Consultation::class);
  }
  function consultations()
  {
    return $this->hasMany(Consultation::class);
  }
}