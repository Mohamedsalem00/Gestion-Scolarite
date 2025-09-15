{{-- Courses Actions Partial --}}
<div class="btn-group" role="group">
    @can('update', $course)
    <a href="{{ route('cours.edit', $course->id_cours) }}" 
       class="btn btn-outline-primary btn-sm" 
       title="{{ __('Modifier') }}">
        <i class="bi bi-pencil"></i>
    </a>
    @endcan
    
    @can('delete', $course)
    <form action="{{ route('cours.destroy', $course->id_cours) }}" 
          method="POST" 
          class="d-inline"
          onsubmit="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer ce cours ?') }}')">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="btn btn-outline-danger btn-sm" 
                title="{{ __('Supprimer') }}">
            <i class="bi bi-trash"></i>
        </button>
    </form>
    @endcan
</div>
