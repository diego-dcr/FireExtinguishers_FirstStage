<div class="modal fade" id="delete-modal-fire-ext" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="form-fire-ext" method="GET" action="{{ route('fire-ext.delete') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="ext-id" name="ext_id" value="">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar extintor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar el extintor?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Eliminar</button>
            </div>
        </form>
    </div>
</div>
