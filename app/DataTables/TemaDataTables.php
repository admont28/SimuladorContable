<?php

namespace App\DataTables;

use App\Tema;
use App\Curso;
use Yajra\Datatables\Services\DataTable;

class TemaDataTables extends DataTable
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
            ->addColumn('opciones', function ($tema) {
                return
                '<a href="'.route('profesor.tema.ver', ['id' => $tema->tema_id]).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
                <a href="'.route('profesor.tema.editar', ['id' => $tema->tema_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                <a href="'.route('profesor.tema.eliminar', ['id' => $tema->tema_id]).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
            })
            ->addColumn('curso', function ($tema)
            {
                return '<a href="'.route('profesor.curso.ver', ['id' => $tema->curs_id]).'">'.$tema->curso->curs_nombre.'</a>';
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
        $temas = Tema::query();
        return $this->applyScopes($temas);
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
                    ->ajax(route('profesor.tema'))
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
                'name' => 'tema_id',
                'title' => 'ID',
                'data' => 'tema_id',
                'width' => '10px'
            ],
            [
                'name' => 'tema_titulo',
                'title' => 'Nombre del tema',
                'data' => 'tema_titulo',
                'width' => '30px'
            ],
            [
                'name' => 'curso',
                'title' => 'Curso al que pertenece',
                'data' => 'curso',
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
        return 'temadatatables_' . time();
    }
}
