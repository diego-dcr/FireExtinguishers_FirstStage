<div class="row justify-content-between align-items-center mb-2">
    <div class="col">
        <h2>Plano/Piso</h2>
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#create-modal-floorplan">
            <i class="bi bi-plus-lg"></i> Agregar
        </button>
    </div>
</div>

<div class="row row-cols-lg-5">
    @foreach ($floorplans as $floorplan)
        <div class="col">
            <div class="card" style="width: 18rem;">
                <img src="data:image/jpeg;base64,{{ base64_encode($floorplan->getImage()) }}"
                    class="card-img-top" alt="Image">
                <div class="card-body">
                    <h5 class="card-title">{{ $floorplan->place }}</h5>
                    <p class="card-text">Piso: {{ $floorplan->floor }}</p>
                    <a href="{{ route('floorplan.edit', ['id' => $floorplan->id, 'section' => $section]) }}" class="btn btn-secondary btn-sm">
                        <i class="far fa-edit"></i> Editar
                    </a>
                    <button class="btn btn-danger btn-sm" onclick="deleteData('floorplan', {{ $floorplan->id }})">
                        <i class="fas fa-times"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>
