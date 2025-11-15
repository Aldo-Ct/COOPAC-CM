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
        <div class="card card-custom p-4 mb-4 text-center border-success">
            <div class="text-success">
                <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
            </div>
            <h4 class="mt-3 mb-2">¡Solicitud Enviada con Éxito!</h4>
            <p class="mb-0">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('tabla_pagos'))
        @php($tabla = session('tabla_pagos'))
        @php($resumen = session('resumen_pagos'))

        <div class="row justify-content-center my-4">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="card card-custom shadow-sm border-success-subtle">
                    <div class="card-header bg-success-subtle px-4 py-3">
                        <h5 class="mb-1 text-success-emphasis">Tabla de Pagos</h5>
                        <p class="mb-0 small text-body-secondary">
                            Plazo: <span class="fw-medium">{{ $resumen['plazo'] }}</span> meses —
                            Cuota fija referencial: <span class="fw-medium">S/ {{ number_format($resumen['cuota'],2) }}</span>
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="p-2 text-center small fw-semibold text-body-secondary text-uppercase">Mes</th>
                                    <th class="p-2 text-end small fw-semibold text-body-secondary text-uppercase">Cuota (S/)</th>
                                    <th class="p-2 text-end small fw-semibold text-body-secondary text-uppercase">Interés (S/)</th>
                                    <th class="p-2 text-end small fw-semibold text-body-secondary text-uppercase">Amortización (S/)</th>
                                    <th class="p-2 text-end small fw-semibold text-body-secondary text-uppercase">Saldo (S/)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tabla as $fila)
                                <tr>
                                    <td class="p-2 text-center text-body-secondary">{{ $fila['n'] }}</td>
                                    <td class="p-2 text-end" style="font-variant-numeric: tabular-nums;">S/ {{ number_format($fila['cuota'],2) }}</td>
                                    <td class="p-2 text-end text-body-secondary" style="font-variant-numeric: tabular-nums;">S/ {{ number_format($fila['interes'],2) }}</td>
                                    <td class="p-2 text-end text-success" style="font-variant-numeric: tabular-nums;">S/ {{ number_format($fila['amortizacion'],2) }}</td>
                                    <td class="p-2 text-end fw-medium" style="font-variant-numeric: tabular-nums;">S/ {{ number_format($fila['saldo'],2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th class="p-3 text-start small fw-semibold text-body-secondary text-uppercase">Totales</th>
                                    <th class="p-3 text-end fw-semibold" style="font-variant-numeric: tabular-nums;">
                                        S/ {{ number_format($resumen['total_pagado'],2) }}
                                    </th>
                                    <th class="p-3 text-end fw-semibold" style="font-variant-numeric: tabular-nums;">
                                        S/ {{ number_format($resumen['total_intereses'],2) }}
                                    </th>
                                    <th class="p-3 text-end fw-semibold" style="font-variant-numeric: tabular-nums;">
                                        S/ {{ number_format($resumen['total_amortizacion'],2) }}
                                    </th>
                                    <th class="p-3"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                {{-- Nota informativa --}}
                <p class="small text-muted mt-2">
                    * Cálculo referencial con TEA 40.92% (convertida a TEM). Los resultados pueden variar según evaluación crediticia.
                </p>
            </div>
        </div>
    @endif

    <div class="row justify-content-center">

        {{-- Sección Unificada --}}
        <div class="col-12 col-lg-8 col-xl-7 @if(session('success')) d-none @endif">
            <div class="card card-custom p-4">
                <div>
                    <h5 class="mb-3">Déjanos tus datos y te llamamos</h5>

                    <form method="POST" action="{{ route('simulador.store') }}" onsubmit="return validarAntesDeEnviar()">
                        @csrf
                        <input type="hidden" name="cuota_estimada" id="cuota_estimada">

                        {{-- Campo oculto para pasar la validación del backend --}}
                        <input type="hidden" name="tipo_credito" value="Crédito de Consumo">

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
                            <input type="text" inputmode="decimal" name="monto_solicitado" class="form-control" required value="{{ old('monto_solicitado', '') }}">
                            @error('monto_solicitado')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Plazo (meses)</label>
                            <input type="number" name="plazo_meses" class="form-control" required value="{{ old('plazo_meses', '') }}">
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
    document.addEventListener('DOMContentLoaded', function() {
        const montoInput = document.querySelector('input[name="monto_solicitado"]');
        const hiddenCuotaInput = document.getElementById('cuota_estimada');

        // --- Función para calcular y guardar la cuota en el campo oculto ---
        function calcularYGuardarCuota() {
            // Limpia el valor del monto para el cálculo (quita comas y espacios)
            const montoLimpio = parseFloat((montoInput.value || '0').toString().replace(/[^0-9.]/g, ''));
            const plazoInput = document.querySelector('input[name="plazo_meses"]');
            const plazo = parseInt(plazoInput.value || '0', 10);

            if (montoLimpio > 0 && plazo > 0) {
                const tea = 0.4092;
                const tem = Math.pow(1 + tea, 1 / 12) - 1;
                const cuota = montoLimpio * (tem * Math.pow(1 + tem, plazo)) / (Math.pow(1 + tem, plazo) - 1);

                // Actualiza el campo oculto para el backend
                hiddenCuotaInput.value = cuota.toFixed(2);
            } else {
                hiddenCuotaInput.value = '0.00';
            }
        }

        // --- Formateo del campo Monto mientras se escribe ---
        function formatMontoInput() {
            let value = montoInput.value.replace(/[^0-9.]/g, ''); // Solo números y punto
            let parts = value.split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Agrega comas de miles
            if (parts.length > 1) {
                parts[1] = parts[1].substring(0, 2); // Limita a 2 decimales
            }
            montoInput.value = parts.join('.');
        }

        // --- Asignación de Eventos ---
        montoInput.addEventListener('input', () => {
            formatMontoInput(); // Formatea mientras escribe
        });

        // --- Validación antes de enviar el formulario ---
        const form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            // Calcula la cuota final justo antes de enviar
            calcularYGuardarCuota();

            // Antes de enviar, nos aseguramos que el valor del monto sea numérico puro
            montoInput.value = (montoInput.value || '0').toString().replace(/[^0-9.]/g, '');

            const monto = parseFloat(montoInput.value || '0');
            const plazo = parseInt(plazoInput.value || '0', 10);

            if (monto <= 0 || plazo <= 0) {
                alert('Por favor, ingrese un monto y plazo válidos para enviar la solicitud.');
                event.preventDefault(); // Detiene el envío del formulario
                formatMontoInput(); // Re-formatea el campo por si se limpió
                return false;
            }

            // Si todo es válido, el formulario se envía.
            return true;
        });

        // --- Ejecución inicial al cargar la página ---
        // Si hay un valor 'old' en el monto, lo formatea
        if (montoInput.value) {
            formatMontoInput();
        }
    });
</script>
@endsection
