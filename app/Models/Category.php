<?php

// Objekt Pauplan was wird vererbt

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $fillable = ['name']; // nur für Laravel sichtbar. nicht von außen veränderbar Kapselung


    public function jobs(){ // Methoden Name Jobs 
        return $this->hasMany(Job::class); // hasMany die aktuell genutzte Kategorie hat viele JOB Klassen
    }
    // 
}
    // Merksatz function Jobs
    //
    //  zwischen Category und Job gibt es eine 1:n-Beziehung.
    //  Die Jobs erkennen ihre Kategorie an der Spalte 'category_id'.
    //  Wenn mich jemand nach meinen Jobs fragt, such in der jobs-Tabelle 
    //  nach allen Einträgen, deren category_id meiner ID entspricht.