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
        protected $fillable = [
        'title',
        'description',
        'location',
        'is_active',
        'expires_at',
        'company_id',
        'category_id',
        'user_id',
    ];
        protected $casts = [
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];
        public function company(){
            
        return $this->belongsTo(Company::class);
    }
        public function category(){
        return $this->belongsTo(Category::class);
    }
        public function user(){

        return $this->belongsTo(User::class);
    }
        public function scopeActive($query){

        return $query->where('is_active', true)
                     ->where(function($q) {
                         $q->whereNull('expires_at')
                           ->orWhere('expires_at', '>', now());
                     });
    }

        public function scopeInLocation($query, $location){

        return $query->where('location', 'like', "%{$location}%");
    }
}

// Merksatz
// Beziehungen (belongsTo) sind wie Wegweiser zu anderen Tabellen.
// Scopes sind  vorgefertigte Filter, die du immer wieder verwenden kannst