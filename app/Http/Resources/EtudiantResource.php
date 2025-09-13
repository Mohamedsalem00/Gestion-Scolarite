<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EtudiantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_etudiant,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'adresse' => $this->adresse,
            'date_naissance' => $this->date_naissance?->format('Y-m-d'),
            'genre' => $this->genre,
            'classe' => new ClasseResource($this->whenLoaded('classe')),
            'notes_count' => $this->when($this->relationLoaded('notes'), fn() => $this->notes->count()),
            'paiements' => $this->when($this->relationLoaded('paiements'), fn() => $this->paiements),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
