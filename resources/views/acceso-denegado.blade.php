<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso restringido</title>

    <!-- Bootstrap solo para maquetar rápido -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        .card-alerta {
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 20px 50px rgba(0,0,0,.15);
            max-width: 360px;
            width: 100%;
            text-align: center;
            padding: 2rem 1.5rem;
            border-top: 6px solid #0d5a28; /* verde institucional */
        }

        .coop-logo {
            max-width: 80px;
            max-height: 80px;
            border-radius: .5rem;
            object-fit: contain;
            background: #fff;
            border: 2px solid #0d5a28;
            padding: .5rem;
            margin-bottom: 1rem;
        }

        .titulo {
            font-weight: 600;
            color: #0d5a28;
            font-size: 1.05rem;
        }

        .mensaje {
            font-size: .9rem;
            color: #555;
            line-height: 1.4;
            margin-top: .5rem;
            margin-bottom: 1.25rem;
        }

        .btn-volver {
            display: inline-block;
            background-color: #0d5a28;
            color: #fff;
            font-weight: 500;
            border-radius: 50px;
            padding: .55rem 1.25rem;
            font-size: .9rem;
            text-decoration: none;
            transition: all .2s ease;
        }

        .btn-volver:hover {
            background-color: #f4e81a;
            color: #0d5a28;
            text-decoration: none;
        }

        small {
            color: #999;
            font-size: .7rem;
        }
    </style>
</head>
<body>

    <div class="card-alerta">

        <img src="/IMAGENES/logo.png"
             alt="Cooperativa Cabanillas Mañazo Ltda."
             class="coop-logo">

        <div class="titulo">
            Acceso denegado
        </div>

        <div class="mensaje">
            Solo personal autorizado puede ingresar al panel administrativo.
        </div>

        <a href="{{ url('/') }}" class="btn-volver">
            Volver al inicio
        </a>

        <div class="mt-3">
            <small>
                Cooperativa de Ahorro y Crédito Cabanillas Mañazo Ltda.
            </small>
        </div>
    </div>

</body>
</html>
