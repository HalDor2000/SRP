<div class="modal fade" id="modal-delete-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLgLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLgLabel">Eliminar registro</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('proveedores.destroy', $item->id) }}">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="row gy-4">
                        <p class="modal-title">¿Está seguro que quiere eliminar el registro?</p>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>

            </form>
        </div>

        </form>
    </div>
</div>
