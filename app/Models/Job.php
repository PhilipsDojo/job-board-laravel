<?php

// Der allgemeine Aufbau des Objekts wird hier erstellt und 
// vom Framework als Klasse bereitgestellt (Vererbung)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model = eine Klasse vom Laravel-Framework
// extends = Job klasse erbt alle Eigenschaften und Methoden der Model Klasse 
// HasFactory = ein TRAIT. Ermöglicht schnellen einsatz von Testdaten

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;
}
