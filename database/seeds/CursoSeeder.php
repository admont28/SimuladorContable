<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_ES');
        /*
         * PRIMER CURSO DE PRUEBA
         */
        $curs_id = \DB::table('Curso')->insertGetId(array(
            'curs_nombre' => "Curso creado desde el seeder para tener un ejemplo completo.",
            'curs_introduccion' => "Curso creado desde el seeder para tener un ejemplo completo."
        ));
        /*
         * 10 MATERIAS DEL CURSO
         */
        for ($i=0; $i < 10; $i++) {
            $mate_id = \DB::table('Materia')->insertGetId(array(
                'mate_nombre' => $faker->realText(rand(10,100)),
                'mate_tema' => $faker->realText(rand(10,1000)),
                'mate_rutaarchivo' => $faker->imageUrl($width = 640, $height = 480),
                'mate_nombrearchivo' => $faker->word(),
                'curs_id' => $curs_id,
            ));
        }
        /*
         * TALLER DIAGNOSTICO
         */
        $tall_id_diagnostico = \DB::table('Taller')->insertGetId(array(
            'tall_nombre' => "Primer taller, de tipo diagnostico.",
            'tall_tipo' => "diagnostico",
            'tall_tiempo' => "2017-05-01 00:00:00",
            'tall_rutaarchivo' => $faker->imageUrl($width = 640, $height = 480),
            'tall_nombrearchivo' => $faker->word(),
            'curs_id' => $curs_id
        ));
        /*
         * TALLER TEORICO
         */
        $tall_id_teorico = \DB::table('Taller')->insertGetId(array(
            'tall_nombre' => "Segundo taller, de tipo teorico.",
            'tall_tipo' => "teorico",
            'tall_tiempo' => "2017-05-01 00:00:00",
            'tall_rutaarchivo' => $faker->imageUrl($width = 640, $height = 480),
            'tall_nombrearchivo' => $faker->word(),
            'curs_id' => $curs_id
        ));
        /*
         * TALLER PRACTICO
         */
        $tall_id_practico = \DB::table('Taller')->insertGetId(array(
            'tall_nombre' => "Tercer taller, de tipo practico.",
            'tall_tipo' => "practico",
            'tall_tiempo' => "2017-05-01 00:00:00",
            'tall_rutaarchivo' => $faker->imageUrl($width = 640, $height = 480),
            'tall_nombrearchivo' => $faker->word(),
            'curs_id' => $curs_id
        ));

        /*
         * PREGUNTA ABIERTA DEL TALLER DIAGNOSTICO
         */
        $preg_id = \DB::table('Pregunta')->insertGetId(array(
            'preg_texto' => "Primer pregunta del taller diagnostico (abierta)",
            'preg_tipo' => "abierta",
            'preg_porcentaje' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 1),
            'tall_id' => $tall_id_diagnostico
        ));
        /*
         * PREGUNTA MULTIPLE DEL TALLER DIAGNOSTICO
         */
        $preg_id_multiple = \DB::table('Pregunta')->insertGetId(array(
            'preg_texto' => "Segunda pregunta del taller diagnostico (multiple)",
            'preg_tipo' => "unica-multiple",
            'preg_porcentaje' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 1),
            'tall_id' => $tall_id_diagnostico
        ));
        /*
         * RESPUESTAS DE LA PREGUNTA MULTIPLE DEL TALLER DIAGNOSTICO
         */
        $remu_id = \DB::table('RespuestaMultipleUnica')->insertGetId(array(
            'remu_texto' => "Respuesta para seleccionar numero 1",
            'remu_correcta' => false,
            'preg_id' => $preg_id_multiple
        ));
        $remu_id = \DB::table('RespuestaMultipleUnica')->insertGetId(array(
            'remu_texto' => "Respuesta para seleccionar numero 2 (correcta)",
            'remu_correcta' => true,
            'preg_id' => $preg_id_multiple
        ));
        $remu_id = \DB::table('RespuestaMultipleUnica')->insertGetId(array(
            'remu_texto' => "Respuesta para seleccionar numero 3",
            'remu_correcta' => false,
            'preg_id' => $preg_id_multiple
        ));
        $remu_id = \DB::table('RespuestaMultipleUnica')->insertGetId(array(
            'remu_texto' => "Respuesta para seleccionar numero 4 (correcta)",
            'remu_correcta' => true,
            'preg_id' => $preg_id_multiple
        ));
        /*
         * PREGUNTA UNICA DEL TALLER DIAGNOSTICO
         */
        $preg_id_unica = \DB::table('Pregunta')->insertGetId(array(
            'preg_texto' => "Tercera pregunta del taller diagnostico (unica)",
            'preg_tipo' => "unica-multiple",
            'preg_porcentaje' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 1),
            'tall_id' => $tall_id_diagnostico
        ));
        /*
         * RESPUESTAS DE LA PREGUNTA UNICA DEL TALLER DIAGNOSTICO
         */
        $remu_id = \DB::table('RespuestaMultipleUnica')->insertGetId(array(
            'remu_texto' => "Respuesta para seleccionar numero 1",
            'remu_correcta' => false,
            'preg_id' => $preg_id_unica
        ));
        $remu_id = \DB::table('RespuestaMultipleUnica')->insertGetId(array(
            'remu_texto' => "Respuesta para seleccionar numero 2",
            'remu_correcta' => false,
            'preg_id' => $preg_id_unica
        ));
        $remu_id = \DB::table('RespuestaMultipleUnica')->insertGetId(array(
            'remu_texto' => "Respuesta para seleccionar numero 3",
            'remu_correcta' => false,
            'preg_id' => $preg_id_unica
        ));
        $remu_id = \DB::table('RespuestaMultipleUnica')->insertGetId(array(
            'remu_texto' => "Respuesta para seleccionar numero 4 (correcta)",
            'remu_correcta' => true,
            'preg_id' => $preg_id_unica
        ));
        /*
         * PREGUNTA ARCHIVO DEL TALLER DIAGNOSTICO
         */
        $preg_id = \DB::table('Pregunta')->insertGetId(array(
            'preg_texto' => "Cuarta pregunta del taller diagnostico (archivo)",
            'preg_tipo' => "archivo",
            'preg_porcentaje' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 1),
            'tall_id' => $tall_id_diagnostico
        ));

        for ($i=0; $i < 100; $i++) {
            $curs_id = \DB::table('Curso')->insertGetId(array(
                'curs_nombre' => $faker->realText(rand(10,100)),
                'curs_introduccion' => $faker->realText(rand(50,500))
            ));

            $tall_id = \DB::table('Taller')->insertGetId(array(
                'tall_nombre' => $faker->realText(rand(10,45)),
                'tall_tipo' => $faker->randomElement(array ('diagnostico','teorico','practico')),
                'tall_tiempo' => $faker->date('Y-m-d H:i:s', $max = 'now'),
                'tall_rutaarchivo' => $faker->imageUrl($width = 640, $height = 480),
                'tall_nombrearchivo' => $faker->word(),
                'curs_id' => $curs_id
            ));

            $mate_id = \DB::table('Materia')->insertGetId(array(
                'mate_nombre' => $faker->realText(rand(10,100)),
                'mate_tema' => $faker->realText(rand(10,1000)),
                'mate_rutaarchivo' => $faker->imageUrl($width = 640, $height = 480),
                'mate_nombrearchivo' => $faker->word(),
                'curs_id' => $curs_id,
            ));

            $preg_id = \DB::table('Pregunta')->insertGetId(array(
                'preg_texto' => $faker->realText(rand(10,45)),
                'preg_tipo' => $faker->randomElement(array ('unica-multiple','abierta','archivo')),
                'preg_porcentaje' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 1),
                'tall_id' =>$tall_id
            ));
        }
    }
}
