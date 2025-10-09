{{-- enseignants Actions Partial --}}
<div class="btn-group" role="group">
    <a href="{{ route('enseignants.show', $teacher->id_enseignant) }}" 
       class="btn btn-outline-secondary btn-sm" 
       title="{{ __('app.voir_details') }}">
        {{ __('app.voir') }}
    </a>
    
    @admin
    <a href="{{ route('enseignants.edit', $teacher->id_enseignant) }}" 
       class="btn btn-outline-primary btn-sm" 
       title="{{ __('app.modifier') }}">
        {{ __('app.modifier') }}
    </a>
    @endadmin
    
    @admin
    <form action="{{ route('enseignants.destroy', $teacher->id_enseignant) }}" 
          method="POST" 
          class="d-inline"
          onsubmit="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer cet enseignant ?') }}')">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="btn btn-outline-danger btn-sm" 
                title="{{ __('app.supprimer') }}">
            {{ __('app.supprimer') }}
        </button>
    </form>
    @endadmin
</div>
