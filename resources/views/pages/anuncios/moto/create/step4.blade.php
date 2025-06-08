@extends('static.layoutHome')
@section('main')
<div class="container my-5">
    @include('pages.anuncios.partials.steps', ['step' => 4])

    <h2 class="text-center fw-bold mb-3">Adicione as fotos do veículo</h2>
    <p class="text-center text-muted mb-4">
        Para reordenar as fotos, você deve clicar na foto e arrastar para posição desejada.
    </p>

    <form action="{{route('anuncio.step4')  }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row justify-content-center mb-4" id="preview-container">
        </div>


        <div class="row justify-content-center">
            @for ($i = 0; $i < 4; $i++)
                <div class="col-6 col-md-3 mb-3">
                    <label class="w-100 border rounded d-flex flex-column align-items-center justify-content-center py-4 cursor-pointer" style="height: 150px;">
                        <input type="file" name="fotos[]" class="d-none foto-input" accept="image/*">
                        <div class="text-center">
                            <i class="bi bi-cloud-arrow-up fs-1 text-muted"></i>
                            <p class="text-muted m-0">Adicionar</p>
                        </div>
                    </label>
                </div>
            @endfor
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('anuncio.step3') }}" class="btn btn-link text-decoration-none">
                &larr; <strong>Voltar</strong>
            </a>
            <button type="submit" class="btn btn-success px-4 py-2">
                Finalizar Anúncio &rarr;
            </button>
        </div>
    </form>
</div>

<style>
    .img-preview {
        position: relative;
        margin: 10px;
        width: 120px;
        height: 120px;
    }

    .img-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .img-preview .menu-icon {
        position: absolute;
        top: 6px;
        right: 6px;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border-radius: 50%;
        padding: 4px 6px;
        cursor: pointer;
    }

    .img-preview .badge {
        position: absolute;
        bottom: -18px;
        left: 50%;
        transform: translateX(-50%);
        background-color: #004E64;
        color: white;
        font-size: 12px;
        padding: 2px 8px;
        border-radius: 20px;
    }

    .cursor-pointer {
        cursor: pointer;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const previewContainer = document.getElementById('preview-container');
        const inputs = document.querySelectorAll('.foto-input');

        let principalSet = false;

        inputs.forEach(input => {
            input.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        const div = document.createElement('div');
                        div.classList.add('img-preview');

                        div.innerHTML = `
                            <img src="${event.target.result}" alt="Foto">
                            <div class="menu-icon">⋮</div>
                            ${!principalSet ? '<div class="badge">Foto principal</div>' : ''}
                        `;

                        previewContainer.appendChild(div);
                        if (!principalSet) principalSet = true;
                    };

                    reader.readAsDataURL(file);
                }
            });
        });
    });
</script>
@endsection