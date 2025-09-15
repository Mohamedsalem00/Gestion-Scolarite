<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'prenom',
        'nom',
        'email',
        'password',
        'role',
        'telephone',
        'matiere',
        'id_classe',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    /**
     * Check if user is an administrator
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a teacher
     */
    public function isEnseignant(): bool
    {
        return $this->role === 'enseignant';
    }



    /**
     * Check if user has a specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user has any of the given roles
     */
    public function hasAnyRole(array $roles): bool
    {
        return in_array($this->role, $roles);
    }

    /**
     * Get user's full name
     */
    public function getFullNameAttribute(): string
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    /**
     * Get the classe this user belongs to (for students and teachers)
     */
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }

    /**
     * Get students for this teacher (if user is a teacher)
     */
    public function etudiants()
    {
        if ($this->isEnseignant()) {
            return $this->hasMany(self::class, 'id_classe', 'id_classe')
                        ->where('role', 'etudiant');
        }
        return null;
    }

    /**
     * Get courses for this teacher (if user is a teacher)
     */
    public function cours()
    {
        if ($this->isEnseignant()) {
            return $this->hasMany(Cours::class, 'id_enseignant');
        }
        return null;
    }

    /**
     * Get notes for this student (if user is a student)
     */
    public function notes()
    {
        if ($this->isEtudiant()) {
            return $this->hasMany(Note::class, 'id_etudiant');
        }
        return null;
    }

    /**
     * Get payments for this teacher (if user is a teacher)
     */
    public function paiements()
    {
        if ($this->isEnseignant()) {
            return $this->hasMany(EnseignPaiement::class, 'id_enseignant');
        } elseif ($this->isEtudiant()) {
            return $this->hasMany(EtudePaiement::class, 'id_etudiant');
        }
        return null;
    }

    /**
     * Get subjects (matieres) this teacher teaches
     */
    public function matieres()
    {
        if ($this->isEnseignant()) {
            return $this->belongsToMany(Matiere::class, 'enseignant_matiere_classe', 'user_id', 'id_matiere')
                        ->withPivot('id_classe', 'active')
                        ->withTimestamps();
        }
        return null;
    }

    /**
     * Get classes this teacher teaches (through subjects)
     */
    public function classesEnseignees()
    {
        if ($this->isEnseignant()) {
            return $this->belongsToMany(Classe::class, 'enseignant_matiere_classe', 'user_id', 'id_classe')
                        ->withPivot('id_matiere', 'active')
                        ->withTimestamps();
        }
        return null;
    }

    /**
     * Get subjects this teacher teaches in a specific class
     */
    public function matieresInClasse($classeId)
    {
        if ($this->isEnseignant()) {
            return $this->matieres()->wherePivot('id_classe', $classeId)->wherePivot('active', true);
        }
        return collect();
    }

    /**
     * Scope to get only active users
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to get users by role
     */
    public function scopeRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Get all admins
     */
    public static function getAdmins()
    {
        return self::where('role', 'admin')->active()->get();
    }

    /**
     * Get all teachers
     */
    public static function getEnseignants()
    {
        return self::where('role', 'enseignant')->active()->get();
    }

    /**
     * Get all students
     */
    public static function getEtudiants()
    {
        return self::where('role', 'etudiant')->active()->get();
    }
}
