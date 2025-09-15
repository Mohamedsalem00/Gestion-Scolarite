<div class="btn-group" role="group">
    <!-- View Button -->
    <a href="{{ route('etudiants.show', $item->id_etudiant) }}" 
       class="btn btn-sm btn-outline-secondary" 
       title="{{ __('app.view') }}">
        <i class="fas fa-eye"></i>
    </a>
    
    <!-- Edit Button -->
    @can('update', $item)
        <a href="{{ route('etudiants.edit', $item->id_etudiant) }}" 
           class="btn btn-sm btn-outline-primary" 
           title="{{ __('app.edit') }}">
            <i class="fas fa-edit"></i>
        </a>
    @endcan
    
    <!-- Delete Button -->
    @can('delete', $item)
        <form action="{{ route('etudiants.destroy', $item->id_etudiant) }}" 
              method="POST" 
              class="d-inline">
            @csrf
            @method('DELETE')
            <button type="button" 
                    class="btn btn-sm btn-outline-danger delete-student" 
                    title="{{ __('app.delete') }}"
                    data-student-name="{{ $item->nom_etudiant }} {{ $item->prenom_etudiant }}">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endcan
</div>
