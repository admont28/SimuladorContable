<?php

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class PucComercialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Se establece a 3 minutos (180 segundos) la ejecución máxima del script.
        ini_set('max_execution_time', 180);
        $file = 'public/storage/puccomercial/PUC-Archivo-Cargable.csv';
        Excel::load($file, function($pucs)
        {
            $valores = array();
            foreach($pucs->get() as $puc)
            {
                $valores[] = [
                    'puco_codigo' => $puc->codigo,
                    'puco_nombre' => $puc->nombre
                ];
            }
            DB::table('PucComercial')->insert($valores);
        });
    }
    
}
