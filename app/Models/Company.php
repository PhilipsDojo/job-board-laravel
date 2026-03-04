<?php

// Bauplan für das Objekt / Modell. Was MUSS ein objekt mitbringen, wenn es hier von erbt
// Merksatz
// "Die Migration sagt der Datenbank: 'description ist TEXT, name ist VARCHAR'.
// Das Model sagt Laravel: 'Diese Felder darfst du befüllen'.
// Laravel vermittelt zwischen beiden."



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;
        // Kapselung&Sicherheit 
        // protected ist die Kapselung Liste NUR für Laravel sichtbar nicht von außen veränderbar
        // fillable die Sicherheit. Nur die folgenden Felder dürfen befüllt werden.
    protected $fillable =[
        'name',
        'description',
        'website',
        'logo',
        'user_id',
    ];
}


// Datenbank merksatz:
// "protected verhindert, dass jemand die Sicherheitsregeln selbst ändert.
// Aber die Datenbank ist immer die letzte Instanz – wenn jemand direkten Zugriff hat, sind alle Regeln egal."