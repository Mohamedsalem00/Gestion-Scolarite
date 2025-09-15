<div class="btn-group" role="group">
    <!-- View Button -->
    <a href="{{ route('classes.show', $item->id_classe) }}" 
       class="btn btn-sm btn-outline-secondary" 
       title="{{ __('app.view') }}">
        <i class="fas fa-eye"></i>
    </a>
    
    <!-- Edit Button -->
    @can('update', $item)
        <a href="{{ route('classes.edit', $item->id_classe) }}" 
           class="btn btn-sm btn-outline-primary" 
           title="{{ __('app.edit') }}">
            <i class="fas fa-edit"></i>
        </a>
    @endcan
    
    <!-- Delete Button -->
    @can('delete', $item)
        <form action="{{ route('classes.destroy', $item->id_classe) }}" 
              method="POST" 
              class="d-inline">
            @csrf
            @method('DELETE')
            <button type="button" 
                    class="btn btn-sm btn-outline-danger delete-class" 
                    title="{{ __('app.delete') }}"
                    data-class-name="{{ $item->nom_classe }}">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endcan
</div>
