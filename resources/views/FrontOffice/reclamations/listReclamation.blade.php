@foreach ($reclamations as $reclamation)
    <tr>
        <td>{{ $reclamation->subject }}</td>
        <td>{{ $reclamation->message }}</td>
        <td>{{ $reclamation->treated ? 'Treated' : 'Not Treated' }}</td>
        <td>
            @if (!$reclamation->treated)
                <form action="{{ route('mark-as-treated', $reclamation) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Specify the HTTP method as PUT -->
                    <button type="submit">Mark as Treated</button>
                </form>
            @else
                <form action="{{ route('mark-as-not-treated', $reclamation) }}" method="POST">
                    @csrf
                    @method('DELETE') <!-- Specify the HTTP method as DELETE -->
                    <button type="submit">Mark as Not Treated</button>
                </form>
            @endif
        </td>
    </tr>
@endforeach
