<!-- Modal 1-->
<div class="modal fade" id="create-modal-fire-ext" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="form-fire-ext" method="POST" action="{{ route('fire-ext.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar extintor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="size" class="form-label is-required">Peso (Kg)</label>
                        <input type="number" class="form-control border-secondary  border-opacity-50" id="size"
                            name="size" value="0" step="0.01" min=0>
                    </div>
                    <div class="col-6">
                        <label for="type" class="form-label is-required">Tipo </label>
                        <input type="text" class="form-control border-secondary  border-opacity-50" id="type"
                            name="type">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label for="size" class="form-label is-required">Lugar</label>
                        <input type="text" class="form-control border-secondary  border-opacity-50" id="place"
                            name="place" placeholder="Área mecánica" value="{{ isset($floorplan->place) ? $floorplan->place : '' }}" required>
                    </div>
                    <div class="col-6">
                        <label for="floor" class="form-label is-required">Piso </label>
                        <input type="number" class="form-control border-secondary  border-opacity-50" id="floor"
                            name="floor" min="0" value="{{ isset($floorplan->floor) ? $floorplan->floor : 0 }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="expiration-date" class="form-label is-required">Fecha de experiación</label>
                        <input type="date"
                            class="form-control border-secondary  border-opacity-50 border-secondary  border-opacity-50"
                            id="expiration-date" name="expiration_date" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="location" class="form-label">Localización (Coordenadas/GPS)</label>
                        <input type="text" class="form-control border-secondary  border-opacity-50" id="location"
                            name="location">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="observations" class="form-label">Observaciones</label>
                        <textarea class="form-control border-secondary  border-opacity-50" id="observations" name="observations" rows="3"></textarea>
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
