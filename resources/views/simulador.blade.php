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

    <div class="row g-4">

        {{-- IZQUIERDA: Simulador --}}
        <div class="col-12 col-lg-6">
            <div class="card card-custom p-3 h-100">
                <h5 class="mb-3">Calcula tu cuota estimada</h5>

                <div class="mb-3">
                    <label class="form-label">Monto solicitado (S/)</label>
                    <input type="number" id="monto" class="form-control" min="1" placeholder="Ej. 3000">
                </div>

                <div class="mb-3">
                    <label class="form-label">Plazo (meses)</label>
                    <input type="number" id="plazo" class="form-control" min="1" placeholder="Ej. 12">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tipo de crédito</label>
                    <select id="tipo" class="form-select">
                        <option value="consumo">Consumo</option>
                        <option value="negocio">Negocio / Emprendimiento</option>
                    </select>
                </div>

                <button class="btn bg-coopac w-100 mb-3" onclick="simular()">Calcular cuota</button>

                <div class="p-3 bg-light border rounded">
                    <p class="mb-1">Cuota estimada mensual:</p>
                    <h4 class="mb-0" id="resultadoCuota">S/ 0.00</h4>
                    <small class="text-muted">
                        *Simulación referencial. Sujeto a evaluación crediticia.
                    </small>
                </div>

                <div class="mt-3 small text-muted">
                    Nota: Este cálculo es solo informativo y no representa una evaluación crediticia formal.
                </div>
            </div>
        </div>

        {{-- DERECHA: Formulario --}}
        <div class="col-12 col-lg-6">
            <div class="card card-custom p-3 h-100">
                <h5 class="mb-3">Déjanos tus datos y te llamamos</h5>

                <form method="POST" action="{{ route('simulador.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nombre completo</label>
                        <input type="text" name="nombre_completo" class="form-control" required>
                        @error('nombre_completo')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">DNI</label>
                        <input type="text" name="dni" class="form-control" required>
                        @error('dni')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Celular / WhatsApp</label>
                        <input type="text" name="celular" class="form-control" required>
                        @error('celular')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Monto solicitado (S/)</label>
                        <input type="number" step="0.01" name="monto_solicitado" class="form-control" required>
                        @error('monto_solicitado')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Plazo (meses)</label>
                        <input type="number" name="plazo_meses" class="form-control" required>
                        @error('plazo_meses')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tipo de crédito</label>
                        <select name="tipo_credito" class="form-select" required>
                            <option value="consumo">Consumo</option>
                            <option value="negocio">Negocio / Emprendimiento</option>
                        </select>
                        @error('tipo_credito')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                            <label class="form-label">Agencia</label>
                            <select name="agencia" class="form-select" required>
                                <option value="">Seleccione su agencia</option>
                                <option value="Cabanillas">Cabanillas</option>
                                <option value="Juliaca">Juliaca</option>
                                <option value="Arequipa - Mariano Melgar">Arequipa - Mariano Melgar</option>
                                <option value="Campo / Visita">Campo / Visita</option>
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
</main>
@endsection

@section('scripts')
<script>
function simular() {
    const monto = parseFloat(document.getElementById('monto').value || 0);
    const plazo = parseInt(document.getElementById('plazo').value || 1);
    const tipo  = document.getElementById('tipo').value;

    let interesMensual = 0.03;
    if (tipo === 'negocio') {
        interesMensual = 0.025;
    }

    if (monto > 0 && plazo > 0) {
        const cuota = (monto / plazo) + (monto * interesMensual);
        document.getElementById('resultadoCuota').innerText = 'S/ ' + cuota.toFixed(2);
    } else {
        document.getElementById('resultadoCuota').innerText = 'S/ 0.00';
    }
}
</script>
@endsection
