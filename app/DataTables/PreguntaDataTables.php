<?php

namespace App\DataTables;

use App\Pregunta;
use Yajra\Datatables\Services\DataTable;

class PreguntaDataTables extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('opciones', function($pregunta){
                return
                '<a href="'.route('profesor.pregunta.ver', ['id' => $pregunta->preg_id]).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
                <a href="'.route('profesor.pregunta.editar', ['id' => $pregunta->preg_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                <a href="'.route('profesor.pregunta.eliminar', ['id' => $pregunta->preg_id]).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
            } )
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Pregunta::query();

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax(route('profesor.pregunta'))
                    //->addAction(['width' => '80px'])
                    ->parameters(
                    [
                        "stateSave" => true,
                        "responsive" => true,
                        "buttons" => [
                        "print"
                        ],
                        "language" => [
                            "url" => "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
                    ],
                ]
                );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name' => 'preg_id',
                'title' => 'ID',
                'data' => 'preg_id',
                'width' => '10px'
            ],
            // add your columns
            [
                'name' => 'preg_texto',
                'title' => 'Texto Pregunta',
                'data' => 'preg_texto',
                'width' => '10px'
            ],
            [
                'name' => 'preg_tipo',
                'title' => 'tipo',
                'data' => 'preg_tipo',
                'width' => '10px'
            ],
            [
                'name' => 'preg_porcentaje',
                'title' => 'Porcentaje',
                'data' => 'preg_porcentaje',
                'width' => '10px'
            ],
            [
                'name' => 'opciones',
                'title' => 'Opciones',
                'data' => 'opciones',
                'searchable' => false,
                'orderable'=> false,
                'width' => '10px'
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'preguntadatatables_' . time();
    }
}
