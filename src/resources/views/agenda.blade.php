<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agenda semanal</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            min-width: 120px;
        }

        th {
            background-color: #f2f2f2;
        }

        .hora {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .menu {
            margin-bottom: 20px;
        }

        .menu a, .menu button {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>Agenda semanal</h1>

    <div class="menu">
        <a href="{{ route('dashboard') }}">Volver al dashboard</a>

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </div>

    @if ($user && $user->children->count() > 0)
        <p><strong>Niño/a:</strong> {{ $user->children->first()->nombre }} {{ $user->children->first()->apellidos }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Hora</th>
                @foreach ($dias as $dia)
                    <th>{{ $dia }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($horas as $hora)
                <tr>
                    <td class="hora">{{ $hora }}</td>
                    @foreach ($dias as $dia)
                        <td contenteditable="true"></td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>