{{-- Courses Actions Partial --}}
<div class="btn-group" role="group">
    @admin
    <a href="{{ route('cours.edit', $course->id_cours) }}" 
       class="btn btn-outline-primary btn-sm">
        {{ __('app.modifier') }}
    </a>
    @endadmin
    
    @admin
    <form action="{{ route('cours.destroy', $course->id_cours) }}" 
          method="POST" 
          class="d-inline"
          onsubmit="return confirm('{{ __('app.confirmer_suppression_cours') }}')">
        @csrf
        @method('DELETE')
        <button type="submit" 
                class="btn btn-outline-danger btn-sm">
            {{ __('app.supprimer') }}
        </button>
    </form>
    @endadmin
</div>
