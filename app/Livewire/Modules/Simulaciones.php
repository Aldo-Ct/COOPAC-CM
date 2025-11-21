<?php

namespace App\Livewire\Modules;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Simulacion;

use Illuminate\Support\Str;

class Simulaciones extends Component
{
    use WithPagination;

    public $perPage = 10;

    // filtros
    public $agencia = '';
    public $estado = '';
    public $tipo_credito = '';
    public $date_from = null;
    public $date_to = null;
    public $search = '';

    // detalle seleccionado
    public $selectedId = null;
    public $deleteId = null;

    // selección y filtros embebidos en la tabla
    public $checkAll = false;
    public $selected = [];
    public $bulkAction = '';

    public $filtroNombre = '';
    public $filtroDni = '';
    public $filtroCelular = '';
    public $filtroMonto = null;
    public $filtroPlazo = null;
    public $filtroTipo = '';
    public $filtroAgencia = '';
    public $filtroEstado = '';
    public $filtroFecha = null;

    protected $queryString = ['agencia', 'estado', 'tipo_credito', 'search'];

    protected $listeners = ['refreshSimulaciones' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFiltroNombre()
    {
        $this->resetPage();
    }

    public function updatingFiltroDni()
    {
        $this->resetPage();
    }

    public function updatingFiltroCelular()
    {
        $this->resetPage();
    }

    public function updatingFiltroMonto()
    {
        $this->resetPage();
    }

    public function updatingFiltroPlazo()
    {
        $this->resetPage();
    }

    public function updatingFiltroTipo()
    {
        $this->resetPage();
    }

    public function updatingFiltroAgencia()
    {
        $this->resetPage();
    }

    public function updatingFiltroEstado()
    {
        $this->resetPage();
    }

    public function updatingFiltroFecha()
    {
        $this->resetPage();
    }

    public function updatingAgencia()
    {
        $this->resetPage();
    }

    public function updatingEstado()
    {
        $this->resetPage();
    }

    public function updatingTipoCredito()
    {
        $this->resetPage();
    }

    public function select($id)
    {
        $this->selectedId = $id;
    }

    /**
     * Propiedad computada para exponer el detalle en la vista como $detalle.
     * Livewire permite usar get{Nombre}Property para exponerlo como $nombre.
     */
    public function getDetalleProperty()
    {
        if (! $this->selectedId) {
            return null;
        }

        return Simulacion::find($this->selectedId);
    }

    public function clearSelection()
    {
        $this->resetFilters();
    }

    public function changeEstado($id, $nuevoEstado)
    {
        $s = Simulacion::find($id);
        if (! $s) return;
        $s->estado = $nuevoEstado;
        $s->save();
    $this->dispatch('simulacion-updated');
    $this->dispatch('refreshSimulaciones')->self();
    }

    public function updatedCheckAll($value)
    {
        if ($value) {
            // seleccionar todos los ids en la página actual
            $ids = $this->getQuery()->pluck('id')->toArray();
            $this->selected = $ids;
        } else {
            $this->selected = [];
        }
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        // Abrir modal en el cliente
    $this->dispatch('open-delete-modal');
    }

    public function deleteConfirmed()
    {
        if (! $this->deleteId) return;

        $s = Simulacion::find($this->deleteId);
        if ($s) {
            $s->delete();
        }

        $this->deleteId = null;
        session()->flash('message', 'Simulación eliminada');
    // Mostrar toast en cliente
    $this->dispatch('show-toast', type: 'success', message: 'Simulación eliminada');
    $this->dispatch('refreshSimulaciones')->self();
    // Cerrar modal en cliente
    $this->dispatch('close-delete-modal');
    }

    /**
     * Exponer detalle del elemento a borrar para mostrar en el modal.
     */
    public function getDeleteDetalleProperty()
    {
        if (! $this->deleteId) return null;
        return Simulacion::find($this->deleteId);
    }

    /**
     * Ejecuta la acción masiva seleccionada sobre los ids en $this->selected
     */
    public function runBulkAction()
    {
        if (empty($this->selected) || ! $this->bulkAction) {
            session()->flash('message', 'Seleccione una acción y al menos un registro.');
            return;
        }

        if ($this->bulkAction === 'delete') {
            Simulacion::whereIn('id', $this->selected)->delete();
            $this->selected = [];
            $this->checkAll = false;
            session()->flash('message', 'Registros eliminados.');
            $this->dispatch('refreshSimulaciones')->self();
            return;
        }

        if ($this->bulkAction === 'export') {
            return $this->exportSelected();
        }
    }

    /**
     * Botón rojo rápido para eliminar seleccionados.
     */
    public function deleteSelected()
    {
        $this->bulkAction = 'delete';
        return $this->runBulkAction();
    }

    /**
     * Exporta los registros seleccionados como CSV.
     */
    public function exportSelected()
    {
        $ids = $this->selected;

        if (empty($ids)) {
            $this->dispatch('show-toast', type: 'error', message: 'No hay registros seleccionados para exportar.');
            return;
        }

        // Construir URL hacia la ruta de export (closure en routes/web.php)
        $params = ['ids' => implode(',', $ids), 'format' => 'xls'];
        $url = route('simulaciones.export', $params);

        // Indicar al navegador que abra la URL para descargar
            $this->dispatch('start-download', url: $url, message: 'Iniciando descarga...');
            $this->dispatch('show-toast', type: 'success', message: 'Preparando exportación...');
        return;
    }

    /**
     * Exportar todos los registros que cumplen los filtros actuales (sin paginación)
     */
    public function exportAll()
    {
        // Usamos los filtros activos para construir la URL de exportación
        $params = $this->getAppliedFilters();
        $params['format'] = 'xls';

        $url = route('simulaciones.export', $params);

        $this->dispatch('start-download', url: $url, message: 'Iniciando descarga...');
        $this->dispatch('show-toast', type: 'success', message: 'Preparando exportación...');
        return;
    }

    public function render()
    {
        $query = Simulacion::query()->latest();

        // filtros del header antiguos (compatibilidad)
        if ($this->agencia) {
            $this->filtroAgencia = $this->agencia;
        }

        if ($this->estado) {
            $this->filtroEstado = $this->estado;
        }

        $query = $this->getQuery();

        $simulaciones = $query->paginate($this->perPage);

        return view('livewire.modules.simulaciones', compact('simulaciones'));
    }

    /**
     * Helper que devuelve el query builder actual (sin paginación) usado para operaciones como seleccionar todos.
     */
    protected function getQuery()
    {
        return Simulacion::query()
            ->when($this->search, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('dni', 'like', '%' . $search . '%')
                        ->orWhere('nombre', 'like', '%' . $search . '%');
                });
            })
            ->when($this->date_from, fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
            ->when($this->date_to, fn ($q, $date) => $q->whereDate('created_at', '<=', $date))
            ->when($this->filtroNombre, fn ($q, $nombre) => $q->where('nombre', 'like', '%' . $nombre . '%'))
            ->when($this->filtroDni, fn ($q, $dni) => $q->where('dni', 'like', '%' . $dni . '%'))
            ->when($this->filtroCelular, fn ($q, $celular) => $q->where('celular', 'like', '%' . $celular . '%'))
            ->when($this->filtroMonto, fn ($q, $monto) => $q->where('monto_solicitado', '>=', $monto))
            ->when($this->filtroPlazo, fn ($q, $plazo) => $q->where('plazo_meses', $plazo))
            ->when($this->filtroTipo, fn ($q, $tipo) => $q->where('tipo_credito', $tipo))
            ->when($this->filtroAgencia, fn ($q, $agencia) => $q->where('agencia', $agencia))
            ->when($this->filtroEstado, fn ($q, $estado) => $q->where('estado', $estado))
            ->when($this->filtroFecha, fn ($q, $fecha) => $q->whereDate('created_at', $fecha))
            ->latest();
    }

    /**
     * Devuelve un array con los filtros que están actualmente aplicados.
     * Útil para la exportación.
     */
    protected function getAppliedFilters(): array
    {
        $filters = [
            'search' => $this->search,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'nombre' => $this->filtroNombre,
            'dni' => $this->filtroDni,
            'celular' => $this->filtroCelular,
            'monto_solicitado' => $this->filtroMonto,
            'plazo_meses' => $this->filtroPlazo,
            'tipo_credito' => $this->filtroTipo,
            'agencia' => $this->filtroAgencia,
            'estado' => $this->filtroEstado,
            'created_at' => $this->filtroFecha,
        ];

        // Unificar filtros de URL y de tabla
        if ($this->agencia) {
            $filters['agencia'] = $this->agencia;
        }
        if ($this->estado) {
            $filters['estado'] = $this->estado;
        }

        // Devolver solo los filtros que tienen valor
        return array_filter($filters);
    }

    /**
     * Restablece filtros y selección a su estado inicial.
     */
    protected function resetFilters(): void
    {
        $this->reset([
            'agencia',
            'estado',
            'tipo_credito',
            'date_from',
            'date_to',
            'search',
            'selectedId',
            'deleteId',
            'checkAll',
            'selected',
            'bulkAction',
            'filtroNombre',
            'filtroDni',
            'filtroCelular',
            'filtroMonto',
            'filtroPlazo',
            'filtroTipo',
            'filtroAgencia',
            'filtroEstado',
            'filtroFecha',
        ]);

        $this->resetPage();
    }
}
