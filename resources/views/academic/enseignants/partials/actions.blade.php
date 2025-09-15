{{-- enseignants Actions Partial --}}
<div class="btn-group" role="group">
    @can('view', $teacher)
    <a href="{{ route('enseignants.show', $teacher->id_enseignant) }}" 
       class="btn btn-outline-secondary btn-sm" 
       title="{{ __('app.voir_details') }}">
        <i class="bi bi-eye"></i>
    </a>
    @endcan
    
    @can('update', $teacher)
    <a href="{{ route('enseignants.edit', $teacher->id_enseignant) }}" 
       class="btn btn-outline-primary btn-sm" 
       title="{{ __('app.modifier') }}">
        <i class="bi bi-pencil"></i>
    </a>
    @endcan
    
    @can('delete', $teacher)
    <form action="{{ route('enseignants.destroy', $teacher->id_enseignant) }}" 
          method="POST" 
          class="d-inline"
          onsubmit="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer cet enseignant ?') }}')">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="btn btn-outline-danger btn-sm" 
                title="{{ __('app.supprimer') }}">
            <i class="bi bi-trash"></i>
        </button>
    </form>
    @endcan
</div>
