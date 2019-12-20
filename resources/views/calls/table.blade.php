<table class="table table-sm">
    <thead class="thead-dark">
    <tr>
        @each('calls.header', $columns, 'column', 'calls.empty')
        <th scope="col">{{ __('Actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($items as $item)
        <tr class="font-weight-light">
            @foreach($columns as $column)
                <td>{{ $item->$column}}</td>
            @endforeach
            <td>
                <form action="{{ URL::current() }}/{{ $item->id }}/delete" method="POST">
                    @method('delete')
                    @csrf
                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Ar You Really?')">{{ __('Delete') }}</button>
                </form>

            </td>
        </tr>
    @empty
        <p>{{ __('No data') }}</p>
    @endforelse
    </tbody>
</table>
