@extends('profesor.template.main')

@section('title', '¡Bienvenido profesor!')

@section('active','#profesor-index')

@section('content')
    <div class="col-md-12">
        <div class="col-md-5 text-center">
            <img src="{{ asset('images/mujer-senala.jpg') }}" alt="Mujer Señala" class="img-responsive">
        </div>
        <div class="col-md-7">
            <h4><strong>(Taller diagnostico)</strong></h4>
            <p class="lead text-justify">Este se realiza por medio de un cuestionario elaborado y cargado por el tutor para conocer el nivel de conocimiento del estudiante y así saber cómo programar las tutorías, Y se compone de la siguiente manera: preguntas con selección múltiple con única respuesta o múltiple respuesta. Calificadas por el sistema. Máximo 2 intentos por el taller. El cuestionario tendrá un tiempo límite para contestar
            Preguntas abiertas. Calificadas por el tutor.</p>
            <h4><strong>(Taller teórico)</strong></h4>
            <p class="lead text-justify">Se presenta el cuestionario con todas las preguntas correspondientes a los temas ilustrados. Preguntas de tipo: selección múltiple con única respuesta o múltiple respuesta y abiertas. El cuestionario tendrá un tiempo límite para contestar. Las preguntas abiertas tienen como respuesta la introducción de texto en línea. Podrán existir preguntas de carga de archivo.</p>
            <h4><strong>(Taller práctico)</strong></h4>
            <p class="lead text-justify">Para proceder al taller práctico el estudiante debe haber finalizado el taller teórico, sin importar la calificación obtenida. Este se desarrollará por medio de un taller el cual será cargado por el profesor por medio de un archivo en formato que él decida siempre y cuando sea compatible con la aplicación web.
            Adicional a esto la aplicación web contara con diferentes opciones que se enumeran a continuación:</p>
            <ol class="lead">
                <li>Mostrar los talleres disponibles en forma de pestañas.</li>
                <li>El estudiante selecciona el taller de su interés o el que deba realizar.</li>
                <li>El estudiante tendrá la posibilidad de ver el PUC en una pestaña de la sección de talleres prácticos.</li>
                <li>Cada taller contendrá un sub-elemento en donde el tutor puede programar las tarifas que considere necesarias para solucionar el taller práctico. Algunas de estas pueden ser:</li>
                <ul>
                    <li>IVA</li>
                    <li>Rete fuente</li>
                    <li>Rete IVA</li>
                    <li>Salud</li>
                    <li>Pensión</li>
                    <li>Y algunas otras…</li>
                </ul>
            </ol>
        </div>
    </div>
@endsection
