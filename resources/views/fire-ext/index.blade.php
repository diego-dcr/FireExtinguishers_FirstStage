<div class="row justify-content-between align-items-center mb-2">
    <div class="col">
        <h2>Extintores</h2>
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#create-modal-fire-ext">
            <i class="bi bi-plus-lg"></i> Agregar
        </button>
    </div>
</div>

<table class="table text-center">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Kg</th>
            <th scope="col">Tipo</th>
            <th scope="col">Fecha de expiración</th>
            <th scope="col">Lugar</th>
            <th scope="col">Piso</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($exts as $ext)
            <tr>
                <td class="align-middle">{{ $ext->id }}</td>
                <td class="align-middle">{{ $ext->size }}</td>
                <td class="align-middle">{{ $ext->type }}</td>
                <td class="align-middle">{{ $ext->expiration_date }}</td>
                <td class="align-middle">{{ $ext->place }}</td>
                <td class="align-middle">{{ $ext->floor }}</td>
                <td class="align-middle">
                    <button class="btn btn-secondary btn-sm" onclick="showData({{ $ext->id }})">
                        <i class="far fa-edit"></i> Editar
                    </button>

                    <button class="btn btn-danger btn-sm" onclick="deleteData('fire-ext', {{ $ext->id }})">
                        <i class="fas fa-times"></i> Eliminar
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
