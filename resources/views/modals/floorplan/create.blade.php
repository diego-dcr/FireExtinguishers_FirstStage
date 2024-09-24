<!-- Modal 1-->
<div class="modal fade" id="create-modal-floorplan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="form-floorplan" method="POST" action="{{ route('floorplan.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar plano</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="size" class="form-label is-required">Lugar</label>
                        <input type="text" class="form-control border-secondary  border-opacity-50" id="place"
                            name="place" placeholder="Área mecánica" required>
                    </div>
                    <div class="col-6">
                        <label for="floor" class="form-label is-required">Piso </label>
                        <input type="number" class="form-control border-secondary  border-opacity-50" id="floor"
                            name="floor" min="0" value="0" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="expiration-date" class="form-label is-required">Imagen del plano</label>
                        <input type="file"
                            class="form-control border-secondary  border-opacity-50 border-secondary  border-opacity-50"
                            id="img" name="img" accept=".jpg, .jpeg, .png, .webp" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>
    </div>
</div>
