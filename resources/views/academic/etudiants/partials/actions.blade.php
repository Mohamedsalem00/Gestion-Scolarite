<div class="btn-group" role="group">
    <!-- View Button -->
    <a href="{{ route('etudiants.show', $item->id_etudiant) }}" 
       class="btn btn-sm btn-outline-secondary" 
       title="{{ __('app.view') }}">
        <i class="fas fa-eye"></i>
    </a>
    
    <!-- Edit Button -->
    @admin
        <a href="{{ route('etudiants.edit', $item->id_etudiant) }}" 
           class="btn btn-sm btn-outline-primary" 
           title="{{ __('app.edit') }}">
            {{ __('app.modifier') }}
        </a>
    @endadmin
    
    <!-- Delete Button -->
    @admin
        <form action="{{ route('etudiants.destroy', $item->id_etudiant) }}" 
              method="POST" 
              class="d-inline">
            @csrf
            @method('DELETE')
            <button type="button" 
                    class="btn btn-sm btn-outline-danger delete-student" 
                    title="{{ __('app.delete') }}"
                    data-student-name="{{ $item->prenom }} {{ $item->nom }}">
                {{ __('app.supprimer') }}
            </button>
        </form>
    @endadmin
</div>
