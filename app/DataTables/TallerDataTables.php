<?php

namespace App\DataTables;

use App\taller;
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
            ->addColumn('opciones', function ($taller) {
                return
                '<a href="'.route('profesor.curso.ver', ['id' => $taller->tall_id]).'" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> Ver</a>
                <a href="'.route('profesor.curso.editar', ['id' => $taller->tall_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                <a href="'.route('profesor.curso.eliminar', ['id' => $taller->tall_id]).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Eliminar</a>';
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
        $query = User::query();

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
                    ->ajax('')
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            // add your columns
            'created_at',
            'updated_at',
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
