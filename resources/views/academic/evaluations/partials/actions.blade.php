<!-- Actions dropdown for evaluation row -->
<div class="dropdown">
    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        <i class="bi bi-three-dots"></i>
    </button>
    <ul class="dropdown-menu">
        <li>
            <a class="dropdown-item" href="{{ route('evaluations.show', $evaluation->id_evaluation) }}">
                <i class="bi bi-eye me-2"></i>
                {{ __('Voir les notes') }}
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="{{ route('evaluations.edit', $evaluation->id_evaluation) }}">
                <i class="bi bi-pencil me-2"></i>
                {{ __('Modifier') }}
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form method="POST" action="{{ route('evaluations.destroy', $evaluation->id_evaluation) }}" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-danger" 
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette évaluation ?')">
                    <i class="bi bi-trash me-2"></i>
                    {{ __('Supprimer') }}
                </button>
            </form>
        </li>
    </ul>
</div>
