@extends('layout')

@section('titulo', 'Simulador de Crédito - Cooperativa')

{{-- Esto pone el menú "Créditos" en estado activo y también el item "Simulador" --}}
@section('activo-creditos', 'active')
@section('activo-simulador', 'active')

@section('contenido')
<main class="container py-4">

    <div class="text-center mb-4">
        <h1 class="fw-bold mb-1">Simula tu Crédito</h1>
        <div class="subtitle">
            Cotiza tu cuota mensual y déjanos tus datos para que un asesor te llame.
        </div>
    </div>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">

        {{-- Sección Unificada --}}
        <div class="col-12 col-lg-8 col-xl-7">
            <div class="card card-custom p-4">
                <div class="mb-5">
                    <h5 class="mb-3">1. Calcula tu cuota estimada</h5>

                    <div class="mb-3">
                        <label class="form-label">Monto solicitado (S/)</label>
                        <input type="number" id="monto" class="form-control" min="1" placeholder="Ej. 3000">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Plazo (meses)</label>
                        <input type="number" id="plazo" class="form-control" min="1" placeholder="Ej. 12">
                    </div>

                    <button class="btn bg-coopac w-100 mb-3" onclick="simular()">Calcular cuota</button>

                    <div class="p-3 bg-light border rounded">
                        <p class="mb-1">Cuota estimada mensual:</p>
                        <h4 class="mb-0" id="resultadoCuota">S/ 0.00</h4>
                        <small class="text-muted">
                            *Simulación referencial con una TEA de 40.92%. Sujeto a evaluación crediticia.
                        </small>
                    </div>

                    <div class="mt-3 small text-muted">
                        Nota: Este cálculo es solo informativo y no representa una evaluación crediticia formal.
                    </div>
                </div>

                <hr class="my-4">

                <div>
                    <h5 class="mb-3">2. Déjanos tus datos y te llamamos</h5>

                    <form method="POST" action="{{ route('simulador.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" name="nombre_completo" class="form-control" required value="{{ old('nombre_completo') }}">
                            @error('nombre_completo')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">DNI</label>
                            <input type="text" name="dni" class="form-control" required pattern="[0-9]{8}" title="El DNI debe contener 8 dígitos." maxlength="8" value="{{ old('dni') }}">
                            @error('dni')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Celular / WhatsApp</label>
                            <input type="text" name="celular" class="form-control" required pattern="[0-9]{9}" title="El celular debe contener 9 dígitos." maxlength="9" value="{{ old('celular') }}">
                            @error('celular')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Monto solicitado (S/)</label>
                            <input type="number" step="0.01" name="monto_solicitado" class="form-control" required value="{{ old('monto_solicitado') }}">
                            @error('monto_solicitado')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Plazo (meses)</label>
                            <input type="number" name="plazo_meses" class="form-control" required value="{{ old('plazo_meses') }}">
                            @error('plazo_meses')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                                <label class="form-label">Agencia</label>
                                <select name="agencia" class="form-select" required>
                                    <option value="">Seleccione su agencia</option>
                                    <option value="Cabanillas" @if(old('agencia') == 'Cabanillas') selected @endif>Cabanillas</option>
                                    <option value="Juliaca" @if(old('agencia') == 'Juliaca') selected @endif>Juliaca</option>
                                    <option value="Arequipa - Mariano Melgar" @if(old('agencia') == 'Arequipa - Mariano Melgar') selected @endif>Arequipa - Mariano Melgar</option>
                                    <option value="Campo / Visita" @if(old('agencia') == 'Campo / Visita') selected @endif>Campo / Visita</option>
                                </select>
                                @error('agencia')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>

                        <button class="btn bg-coopac w-100" type="submit">
                            Enviar solicitud
                        </button>

                        <div class="form-text mt-3">
                            Acepto que la Cooperativa use mis datos para contactarme con fines crediticios.
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
function simular() {
    const monto = parseFloat(document.getElementById('monto').value || 0);
    const plazo = parseInt(document.getElementById('plazo').value || 1);
    // Obtener los elementos del DOM
    const montoInput = document.getElementById('monto');
    const plazoInput = document.getElementById('plazo');
    const resultadoCuotaEl = document.getElementById('resultadoCuota');

    // Obtener los campos del formulario de abajo
    const formMontoInput = document.querySelector('input[name="monto_solicitado"]');
    const formPlazoInput = document.querySelector('input[name="plazo_meses"]');

    // Obtener valores
    const monto = parseFloat(montoInput.value || 0);
    const plazo = parseInt(plazoInput.value || 1);

    // Tasa Efectiva Anual (TEA) del 40.92%
    const tea = 0.4092;
    // Convertir TEA a Tasa Efectiva Mensual (TEM)
    const tem = Math.pow(1 + tea, 1/12) - 1;

    if (monto > 0 && plazo > 0) {
    if (monto > 0 && plazo > 0 && montoInput && plazoInput && resultadoCuotaEl) {
        const cuota = monto * (tem * Math.pow(1 + tem, plazo)) / (Math.pow(1 + tem, plazo) - 1);
        document.getElementById('resultadoCuota').innerText = 'S/ ' + cuota.toLocaleString('es-PE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        resultadoCuotaEl.innerText = 'S/ ' + cuota.toLocaleString('es-PE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

        // Conectar con el formulario: copiar los valores a los campos de abajo
        if (formMontoInput) formMontoInput.value = monto.toFixed(2);
        if (formPlazoInput) formPlazoInput.value = plazo;

    } else {
        document.getElementById('resultadoCuota').innerText = 'S/ 0.00';
        if (resultadoCuotaEl) resultadoCuotaEl.innerText = 'S/ 0.00';
    }
}
</script>
@endsection
