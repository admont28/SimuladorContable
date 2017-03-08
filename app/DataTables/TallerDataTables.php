<?php

namespace App\DataTables;

use App\Taller;
use Yajra\Datatables\Services\DataTable;

class TallerDataTables extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {

            return $this->datatable
            ->eloquent($this->query())
            ->addColumn('opciones', function ($taller) {
                return
                '<a href="'.route('profesor.taller.ver', ['tall_id' => $taller->tall_id]).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
                <a href="'.route('profesor.taller.editar', ['tall_id' => $taller->tall_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                <a href="'.route('profesor.taller.eliminar', ['tall_id' => $taller->tall_id]).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
            })
            //->addColumn('action', 'path.to.action.view')
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
    $query = Taller::query();

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
                    ->ajax(route('profesor.taller'))
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
                            ]
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
                'name' => 'tall_id',
                'title' => 'ID',
                'data' => 'tall_id',
                'width' => '10px'
            ],
            [
                'name' => 'tall_nombre',
                'title' => 'Nombre del taller',
                'data' => 'tall_nombre',
                'width' => '30px'
            ],
            [
                'name' => 'tall_tipo',
                'title' => 'tipo de taller',
                'data' => 'tall_tipo',
                'width' => '30px'
            ],
            [
                'name' => 'tall_tiempo',
                'title' => 'tiempo del taller',
                'data' => 'tall_tiempo',
                'width' => '30px'
            ],
            [
                'name' => 'curs_id',
                'title' => 'curso',
                'data' => 'curs_id',
                'width' => '30px'

            ],
            [
                'name' => 'opciones',
                'title' => 'Opciones',
                'data' => 'opciones',
                'searchable' => false,
                'orderable'=> false,
                'width' => '10px'
            ]
            // add your columns
            //'name',
            //'Introducción',
            //'created_at',
            //2'updated_at',
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'tallerdatatables_' . time();
    }
}
