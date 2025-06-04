{{-- resources/views/pages/anuncios/meus.blade.php --}}
@extends('static.layoutHome')

@section('main')
<div class="container mt-4">
    <h2>Meus Anúncios</h2>
    @if($meusAnuncios->isEmpty())
        <p>Você ainda não publicou nenhum anúncio.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meusAnuncios as $anuncio)
                    <tr>
                        <td>{{ $anuncio->id }}</td>
                        <td>{{ $anuncio->titulo }}</td>
                        <td>{{ $anuncio->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('anuncio.show', $anuncio->id) }}" class="btn btn-sm btn-info">
                                Ver
                            </a>
                            {{-- Se existir rota de edição --}}
                            <a href="{{ route('anuncio.edit', $anuncio->id) }}" class="btn btn-sm btn-warning">
                                Editar
                            </a>
                            {{-- Se existir rota de exclusão --}}
                            <form action="{{ route('anuncio.destroy', $anuncio->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Deseja mesmo excluir este anúncio?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $meusAnuncios->links() }}
    @endif
</div>
@endsection
