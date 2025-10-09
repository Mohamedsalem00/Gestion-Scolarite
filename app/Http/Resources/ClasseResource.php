<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClasseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $locale = app()->getLocale();
        
        return [
            'id' => $this->id_classe,
            'nom_classe' => $this->nom_classe,
            'niveau' => $this->niveau,
            'nom_classe_translated' => $this->getTranslation('nom_classe', $locale),
            'niveau_translated' => $this->getTranslation('niveau', $locale),
            'translations' => [
                'nom_classe' => $this->nom_classe_translations,
                'niveau' => $this->niveau_translations,
            ],
            'etudiants_count' => $this->when($this->relationLoaded('etudiants'), fn() => $this->etudiants->count()),
            'enseignants_count' => $this->when($this->relationLoaded('enseignants'), fn() => $this->enseignants->count()),
            'cours_count' => $this->when($this->relationLoaded('cours'), fn() => $this->cours->count()),
            'evaluations_count' => $this->when($this->relationLoaded('evaluations'), fn() => $this->evaluations->count()),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
