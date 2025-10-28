@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="text-center mb-4">Dashboard Cooperativa Financiera</h1>

    <!-- Pestañas -->
    <ul class="nav nav-tabs mb-3" id="dashboardTabs" role="tablist">
        @foreach(['Clientes','Créditos','Pagos','Solicitudes','Citas','Tipos de Créditos'] as $i => $mod)
        <li class="nav-item" role="presentation">
            <button class="nav-link {{$i==0?'active':''}}" id="{{strtolower(str_replace(' ','_',$mod))}}-tab"
                data-bs-toggle="tab" data-bs-target="#{{strtolower(str_replace(' ','_',$mod))}}" type="button" role="tab">
                {{$mod}}
            </button>
        </li>
        @endforeach
    </ul>

    <!-- Contenido de pestañas -->
    <div class="tab-content">
        <!-- Clientes -->
        <div class="tab-pane fade show active" id="clientes" role="tabpanel">
            <a href="{{ route('clientes.pdf') }}" class="btn btn-primary mb-2">Exportar PDF</a>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th><th>Nombre</th><th>Apellido</th><th>Identificación</th>
                        <th>Fecha Nacimiento</th><th>Teléfono</th><th>Email</th><th>Dirección</th>
                        <th>Ocupación</th><th>Ingreso Mensual</th><th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->nombre }}</td>
                        <td>{{ $c->apellido }}</td>
                        <td>{{ $c->identificacion }}</td>
                        <td>{{ $c->fecha_nacimiento }}</td>
                        <td>{{ $c->telefono }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ $c->direccion }}</td>
                        <td>{{ $c->ocupacion }}</td>
                        <td>{{ number_format($c->ingreso_mensual,2) }}</td>
                        <td>{{ ucfirst($c->estado) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Créditos -->
        <div class="tab-pane fade" id="créditos" role="tabpanel">
            <a href="{{ route('creditos.pdf') }}" class="btn btn-success mb-2">Exportar PDF</a>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th><th>Cliente</th><th>Tipo</th><th># Crédito</th><th>Monto Capital</th>
                        <th>Tasa Anual</th><th>Plazo Meses</th><th>Fecha Desembolso</th>
                        <th>Fecha Finalización</th><th>Saldo</th><th>Cuota Mensual</th>
                        <th>Interés Total</th><th>Estado</th><th>Pagos Realizados</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($creditos as $cr)
                    <tr>
                        <td>{{ $cr->id }}</td>
                        <td>{{ $cr->cliente->nombre }} {{ $cr->cliente->apellido }}</td>
                        <td>{{ $cr->tipo->nombre }}</td>
                        <td>{{ $cr->numero_credito }}</td>
                        <td>{{ number_format($cr->monto_capital,2) }}</td>
                        <td>{{ $cr->tasa_anual }}%</td>
                        <td>{{ $cr->plazo_meses }}</td>
                        <td>{{ $cr->fecha_desembolso->format('d/m/Y') }}</td>
                        <td>{{ $cr->fecha_finalizacion->format('d/m/Y') }}</td>
                        <td>{{ number_format($cr->saldo,2) }}</td>
                        <td>{{ number_format($cr->cuota_mensual,2) }}</td>
                        <td>{{ number_format($cr->interes_total,2) }}</td>
                        <td>{{ ucfirst($cr->estado) }}</td>
                        <td>{{ $cr->pagos_realizados }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagos -->
        <div class="tab-pane fade" id="pagos" role="tabpanel">
            <a href="{{ route('pagos.pdf') }}" class="btn btn-warning mb-2">Exportar PDF</a>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th><th>Crédito #</th><th>Usuario</th><th>Fecha Pago</th>
                        <th>Monto Pagado</th><th>Tipo Pago</th><th>Saldo Después</th><th>Nota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pagos as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->credito->numero_credito }}</td>
                        <td>{{ $p->user->name }}</td>
                        <td>{{ $p->fecha_pago->format('d/m/Y H:i') }}</td>
                        <td>{{ number_format($p->monto_pagado,2) }}</td>
                        <td>{{ $p->tipo_pago }}</td>
                        <td>{{ number_format($p->saldo_despues,2) }}</td>
                        <td>{{ $p->nota }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Solicitudes -->
        <div class="tab-pane fade" id="solicitudes" role="tabpanel">
            <a href="{{ route('solicitudes.pdf') }}" class="btn btn-danger mb-2">Exportar PDF</a>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th><th>Cliente</th><th>Tipo Crédito</th><th>Monto Solicitado</th>
                        <th>Plazo Meses</th><th>Ingresos Declarados</th><th>Estado</th>
                        <th>Observaciones</th><th>Revisado Por</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solicitudes as $s)
                    <tr>
                        <td>{{ $s->id }}</td>
                        <td>{{ $s->cliente->nombre }} {{ $s->cliente->apellido }}</td>
                        <td>{{ $s->tipo->nombre }}</td>
                        <td>{{ number_format($s->monto_solicitado,2) }}</td>
                        <td>{{ $s->plazo_meses }}</td>
                        <td>{{ number_format($s->ingresos_declared,2) }}</td>
                        <td>{{ ucfirst($s->estado) }}</td>
                        <td>{{ $s->observaciones }}</td>
                        <td>{{ $s->revisor ? $s->revisor->name : '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Citas -->
        <div class="tab-pane fade" id="citas" role="tabpanel">
            <a href="{{ route('citas.pdf') }}" class="btn btn-info mb-2">Exportar PDF</a>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th><th>Cliente</th><th>Usuario</th><th>Fecha/Hora</th><th>Tipo</th><th>Estado</th><th>Notas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->cliente->nombre }} {{ $c->cliente->apellido }}</td>
                        <td>{{ $c->user->name }}</td>
                        <td>{{ $c->fecha_hora->format('d/m/Y H:i') }}</td>
                        <td>{{ $c->tipo }}</td>
                        <td>{{ ucfirst($c->estado) }}</td>
                        <td>{{ $c->notas }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tipos de Créditos -->
        <div class="tab-pane fade" id="tipos_de_créditos" role="tabpanel">
            <a href="{{ route('tipos_creditos.pdf') }}" class="btn btn-dark mb-2">Exportar PDF</a>
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th><th>Código</th><th>Nombre</th><th>Descripción</th>
                        <th>Tasa Anual</th><th>Plazo Min</th><th>Plazo Max</th><th>Monto Min</th><th>Monto Max</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tipos_creditos as $t)
                    <tr>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->codigo }}</td>
                        <td>{{ $t->nombre }}</td>
                        <td>{{ $t->descripcion }}</td>
                        <td>{{ $t->tasa_anual }}%</td>
                        <td>{{ $t->plazo_min_meses }}</td>
                        <td>{{ $t->plazo_max_meses }}</td>
                        <td>{{ number_format($t->monto_min,2) }}</td>
                        <td>{{ number_format($t->monto_max,2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
fetch("{{ route('dashboard.data') }}")
.then(res=>res.json())
.then(data=>{
    const ctx = document.createElement('canvas');
    document.body.appendChild(ctx);
    new Chart(document.getElementById('monthlyChart'),{
        type:'bar',
        data:{
            labels:['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
            datasets:[
                {label:'Pagos', data:data.pagos, backgroundColor:'#007bff'},
                {label:'Créditos', data:data.creditos, backgroundColor:'#28a745'}
            ]
        }
    });
});
</script>
@endsection
