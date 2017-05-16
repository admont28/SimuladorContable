<?php

namespace App\DataTables;

use App\Curso;
use Yajra\Datatables\Services\DataTable;

class CursoDataTables extends DataTable
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
            ->addColumn('opciones', function ($curso) {
                $method_field = method_field('DELETE');
                $csrf_field = csrf_field();
                return
                '<a href="'.route('profesor.curso.ver', ['id' => $curso->curs_id]).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
                <a href="'.route('profesor.curso.editar', ['id' => $curso->curs_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                <form action="'.route('profesor.curso.eliminar', ['id' => $curso->curs_id]).'" method="POST" class="visible-lg-inline-block visible-sm-inline-block visible-md-inline-block visible-xs-inline-block">
                    '.$method_field.'
                    '.$csrf_field.'
                    <button type="submit" name="eliminar" class="btn btn-xs btn-danger btn-eliminar"><i class="glyphicon glyphicon-trash"></i> Eliminar</button>
                </form>';
            })
            //->addColumn('action', 'path.to.action.view')
            ->rawColumns(['opciones'])
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Curso::query();

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
                    ->ajax(route('profesor.curso'))
                    ->parameters(
                        [
                            'dom'       => 'lBfrtip',
                            "responsive"=> true,
                            "stateSave" => true,
                            "responsive" =>  true,
                            "lengthMenu" => [5, 10, 25, 50, 75, 100],
                            "buttons" => ['reset', 'reload'],
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
                'name' => 'curs_id',
                'title' => 'ID',
                'data' => 'curs_id',
                'width' => '5%'
            ],
            [
                'name' => 'curs_nombre',
                'title' => 'Nombre del curso',
                'data' => 'curs_nombre',
                'width' => '20%'
            ],
            [
                'name' => 'curs_introduccion',
                'title' => 'Introducción del curso',
                'data' => 'curs_introduccion',
                'width' => '55%'
            ],
            [
                'name' => 'opciones',
                'title' => 'Opciones',
                'data' => 'opciones',
                'searchable' => false,
                'orderable'=> false,
                'exportable' => false,
                'printable' => false,
                'width' => '20%'
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
        return 'cursodatatables_' . time();
    }
}
