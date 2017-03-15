<?php

namespace App\DataTables;

use App\Materia;
use Yajra\Datatables\Services\DataTable;

class MateriaDataTables extends DataTable
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
            ->addColumn('opciones', function ($materia) {
                return
                '<a href="'.route('profesor.materia.ver', ['id' => $materia->mate_id]).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
                <a href="'.route('profesor.materia.editar', ['id' => $materia->mate_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                <a href="'.route('profesor.materia.eliminar', ['id' => $materia->mate_id]).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
            })
            /*->addColumn('curso', function ($materia)
            {
                return '<a href="'.route('profesor.curso.ver', ['id' => $materia->curs_id]).'">'.$materia->curso->curs_nombre.'</a>';
            })*/
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
        $materias = Materia::query();
        return $this->applyScopes($materias);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        //dd($this);
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax(route('profesor.curso.materia', ['curs_id' => 2]))
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
                'name' => 'mate_id',
                'title' => 'ID',
                'data' => 'mate_id',
                'width' => '10px'
            ],
            [
                'name' => 'mate_nombre',
                'title' => 'Nombre de la materia',
                'data' => 'mate_nombre',
                'width' => '30px'
            ],
            [
                'name' => 'mate_tema',
                'title' => 'Tema de la materia',
                'data' => 'mate_tema',
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
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'materiadatatables_' . time();
    }
}
