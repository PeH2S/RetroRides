<div class="d-flex justify-content-around mb-3 mt-5 text-center">
    <div class="{{ $step >= 1 ? 'fw-bold text-success' : '' }}" style="color: #004E64;">1. Dados</div>
    <div class="{{ $step >= 2 ? 'fw-bold text-success' : '' }}" style="color: #004E64;">2. Opcionais</div>
    <div class="{{ $step >= 3 ? 'fw-bold text-success' : '' }}" style="color: #004E64;">3. Condições</div>
    <div class="{{ $step >= 4 ? 'fw-bold text-success' : '' }}" style="color: #004E64;">4. Fotos</div>
</div>
<div class="progress mb-4" style="height: 5px;">
    <div class="progress-bar" style="width: {{ $step * 25 }}%; background-color:#004E64"></div>
</div>
