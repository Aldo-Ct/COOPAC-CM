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
        $this->selectedId = null;
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
        $params = ['ids' => implode(',', $ids)];
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
        // Generar parámetros según filtros actuales para la ruta de export
        $params = [];
        if ($this->filtroAgencia) $params['agencia'] = $this->filtroAgencia;
        if ($this->filtroEstado) $params['estado'] = $this->filtroEstado;
        if ($this->filtroTipo) $params['tipo_credito'] = $this->filtroTipo;
        if ($this->filtroFecha) $params['date_from'] = $this->filtroFecha;
        if ($this->filtroFecha) $params['date_to'] = $this->filtroFecha;
        if ($this->search) $params['search'] = $this->search;

        $url = route('simulaciones.export', $params);

            $this->dispatch('start-download', url: $url, message: 'Iniciando descarga...');
            $this->dispatch('show-toast', type: 'success', message: 'Preparando exportación...');
        return;
    }
    // Aquí iremos agregando propiedades y métodos según los requerimientos.
    // Por ahora es un scaffold vacío.

    public function render()
    {
        $query = Simulacion::query()->latest();

        // filtros del header antiguos (compatibilidad)
        if ($this->agencia) {
            $query->where('agencia', $this->agencia);
        }

        if ($this->estado) {
            $query->where('estado', $this->estado);
        }

        if ($this->tipo_credito) {
            $query->where('tipo_credito', $this->tipo_credito);
        }

        if ($this->date_from) {
            $query->whereDate('created_at', '>=', $this->date_from);
        }

        if ($this->date_to) {
            $query->whereDate('created_at', '<=', $this->date_to);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('dni', 'like', '%'.$this->search.'%')
                  ->orWhere('nombre', 'like', '%'.$this->search.'%');
            });
        }

        // filtros embebidos (fila de filtros)
        if ($this->filtroNombre) {
            $query->where('nombre', 'like', '%'.$this->filtroNombre.'%');
        }

        if ($this->filtroDni) {
            $query->where('dni', 'like', '%'.$this->filtroDni.'%');
        }

        if ($this->filtroCelular) {
            $query->where('celular', 'like', '%'.$this->filtroCelular.'%');
        }

        if ($this->filtroMonto) {
            $query->where('monto_solicitado', '>=', $this->filtroMonto);
        }

        if ($this->filtroPlazo) {
            $query->where('plazo_meses', $this->filtroPlazo);
        }

        if ($this->filtroTipo) {
            $query->where('tipo_credito', $this->filtroTipo);
        }

        if ($this->filtroAgencia) {
            $query->where('agencia', $this->filtroAgencia);
        }

        if ($this->filtroEstado) {
            $query->where('estado', $this->filtroEstado);
        }

        if ($this->filtroFecha) {
            $query->whereDate('created_at', $this->filtroFecha);
        }

        $simulaciones = $query->paginate($this->perPage);

        return view('livewire.modules.simulaciones', compact('simulaciones'));
    }

    /**
     * Helper que devuelve el query builder actual (sin paginación) usado para operaciones como seleccionar todos.
     */
    protected function getQuery()
    {
        $query = Simulacion::query()->latest();

        // aplicar mismos filtros mínimos (solo los embebidos para selección)
        if ($this->filtroNombre) $query->where('nombre', 'like', '%'.$this->filtroNombre.'%');
        if ($this->filtroDni) $query->where('dni', 'like', '%'.$this->filtroDni.'%');
        if ($this->filtroCelular) $query->where('celular', 'like', '%'.$this->filtroCelular.'%');
        if ($this->filtroMonto) $query->where('monto_solicitado', '>=', $this->filtroMonto);
        if ($this->filtroPlazo) $query->where('plazo_meses', $this->filtroPlazo);
        if ($this->filtroTipo) $query->where('tipo_credito', $this->filtroTipo);
        if ($this->filtroAgencia) $query->where('agencia', $this->filtroAgencia);
        if ($this->filtroEstado) $query->where('estado', $this->filtroEstado);
        if ($this->filtroFecha) $query->whereDate('created_at', $this->filtroFecha);

        return $query;
    }
}
