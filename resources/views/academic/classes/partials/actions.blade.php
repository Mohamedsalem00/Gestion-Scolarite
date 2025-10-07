<div class="btn-group" role="group">
    <!-- View Button -->
    <a href="{{ route('classes.show', $item->id_classe) }}" 
       class="btn btn-sm btn-outline-secondary">
        {{ __('app.voir') }}
    </a>
    
    <!-- Edit Button -->
    @admin
        <a href="{{ route('classes.edit', $item->id_classe) }}" 
           class="btn btn-sm btn-outline-primary">
            {{ __('app.modifier') }}
        </a>
    @endadmin
    
    <!-- Delete Button -->
    @admin
        <form action="{{ route('classes.destroy', $item->id_classe) }}" 
              method="POST" 
              class="d-inline">
            @csrf
            @method('DELETE')
            <button type="button"
                    class="btn btn-sm btn-outline-danger delete-class"
                    data-class-name="{{ $item->nom_classe }}">
                {{ __('app.supprimer') }}
            </button>
        </form>
    @endadmin
</div>
