@props([
    'columns' => [],
    'id' => 'dataTable',
    'striped' => true,
    'bordered' => false,
    'hover' => true,
    'responsive' => true
])

<div class="{{ $responsive ? 'table-responsive' : '' }}">
    <table 
        @if($id) id="{{ $id }}" @endif
        class="table 
            @if($striped) table-striped @endif
            @if($bordered) table-bordered @endif  
            @if($hover) table-hover @endif
        ">
        @if(!empty($columns))
            <thead class="table-dark">
                <tr>
                    @foreach($columns as $column)
                        <th>{{ $column['label'] ?? $column['key'] ?? $column }}</th>
                    @endforeach
                </tr>
            </thead>
        @endif
        
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>