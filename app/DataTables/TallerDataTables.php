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
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('opciones',function($taller){
                    return '<a href="'.route('profesor.taller.ver', ['id' => $taller->tall_id]).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>';
            })
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
                            "responsive" =>  true,
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
                'title' => 'Tipo de taller',
                'data' => 'tall_tipo',
                'width' => '30px',
                'searchable' => false,
                'orderable'=> false,
            ],
            [
                'name' => 'opciones',
                'title' => 'Opciones',
                'data' => 'opciones',
                'searchable' => false,
                'orderable'=> false,
                'width' => '10px'
            ]
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
