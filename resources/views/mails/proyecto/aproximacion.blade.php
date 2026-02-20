@extends('mails.index')

@section('content')
    <td align="left" valign="center">
        <div style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">
            <!--begin:Email content-->
            <div style="padding-bottom: 30px; font-size: 17px;">
                <strong style="font-family: 2rem;">Advertencia de Presupuesto</strong>
            </div>
            <div style="padding-bottom: 30px; font-size: 17px;">
                <strong>Hola! {{$usuario->nombre_completo}}</strong>
            </div>

            <div style="padding-bottom: 30px">
                Queremos informarte que el proyecto {{$proyecto->nombre}} está acercándose al límite de su presupuesto.
            </div>
            <div style="padding-bottom: 30px">
                <ul>
                    <li><b>Total Presupuestado:</b>${{formatoMiles($proyecto->presupuestoActivo->valor)}}</li>
                    <li><b>Total Gastado:</b>${{formatoMiles($proyecto->presupuestoActivo->valor_gastador)}}</li>
                </ul>
            </div>

            <div style="padding-bottom: 40px; text-align:center;">
                <a href="{{ route('proyectos.edit', ['proyecto' => $proyecto->id]) }}" rel="noopener" target="_blank"
                    style="text-decoration:none;display:inline-block;text-align:center;padding:0.75575rem 1.3rem;font-size:0.925rem;line-height:1.5;border-radius:0.35rem;color:#ffffff;background-color:#04dce9;border:0px;margin-right:0.75rem!important;font-weight:600!important;outline:none!important;vertical-align:middle">
                    Ver proyecto
                </a>
            </div>
            <!--end:Email content-->

            <div style="padding-bottom: 10px">
                Tu contribución ha sido invaluable. ¡Felicitaciones por el excelente trabajo!
                <br>
                Saludos cordiales,
            </div>

            <div style="padding-bottom: 10px">
                GIJAC WEB
            </div>
        </div>
    </td>
@endsection
