@extends('layouts.app')

@section('content')
    @php
        $base64 = base64_encode($floorplan->getImage());
        $imageUrl = 'data:image/jpeg;base64,' . $base64;
    @endphp
    <style>
        #image-container {
            overflow: auto;
        }

        #zoom-wrapper {
            width: 100%;
            height: 100%;
        }

        #image-container {
            position: relative;
            overflow: auto;
        }

        .fire-icon {
            position: absolute;
            width: 24px;
            /* Ajusta el ancho según necesites */
            height: 24px;
            /* Ajusta la altura según necesites */
            cursor: pointer;
        }


        #points-container {
            position: relative;
            user-select: none;
            width: 100%;
            height: 100%;
            background-image: url({{ $imageUrl }});
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>

    <form class="m-0 h-100" method="POST" action="{{ route('floorplan.update', ['id' => $floorplan->id]) }}"
        enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-between align-items-center p-5 pt-3 pb-0">
            <div class="col">
                <div class="d-flex flex-row justify-content-start align-items-center">
                    <a href="{{ route('landscape', ['section' => 2]) }}" class="me-3 fs-4 text-decoration-none text-primary">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h2 class="mb-0">Plano [Piso: {{ $floorplan->floor }}]</h2>
                </div>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary" onclick="saveData()">Guardar</button>
            </div>
        </div>
        <div class="row p-5 mb-3">
            <div class="col">
                <div class="list-group">
                    <div
                        class="list-group-item list-group-item-action bg-dark border-dark text-light d-flex justify-content-between align-items-center">
                        <span>Extintores</span>
                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#create-modal-fire-ext">
                            <i class="bi bi-plus-lg"></i> 
                        </button>
                    </div>
                    @foreach ($exts as $ext)
                        <button type="button" class="list-group-item list-group-item-action border-dark"
                            id="{{ $ext->id }}" onclick="selectExt(this.id)">
                            <div class="d-flex" id="fire-ext-content{{ $ext->id }}">
                                <div class="icon">
                                    <span class="material-symbols-outlined text-danger fs-1">
                                        fire_extinguisher
                                    </span>
                                </div>
                                <div class="description row">
                                    <span class="col-12"><span class="fw-bold">ID: </span> {{ $ext->id }}</span>
                                    <span class="col-12"><span class="fw-bold">Área: </span> {{ $ext->place }}</span>
                                    <span class="col-12"><span class="fw-bold">Piso: </span> {{ $ext->floor }}</span>
                                    <span class="col-12"><span class="fw-bold">Fecha de expiración: </span>
                                        {{ $ext->expiration_date }}</span>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="col-10">
                <div class="row mb-3">
                    <label for="zoom-range" class="col-auto form-label fw-bold">Zoom: </label>
                    <div class="col-11">
                        <input type="range" id="zoom-range" min="1" max="4" step="0.1" value="1"
                            class="form-range border border-secondary rounded">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div id="image-container" class="border border-2 border-dark rounded shadow-sm mb-4 ">
                        <div id="points-container" style="position: absolute; top: 0; left: 0;"></div>
                    </div>
                </div>
                <input type="hidden" id="points" name="points" value="">
            </div>
        </div>
    </form>

    @include('modals.fire_ext.create')

    <script>
        var devices = @json($devices);
        var container = document.getElementById('points-container');
        var imageContainer = document.getElementById('image-container');
        var zoomRange = document.getElementById('zoom-range');
        var img = new Image();
        var points = [];
        var pointID = 0;
        var color = '#dc3545';

        function applyZoom() {
            var zoomLevel = parseFloat(zoomRange.value);
            container.style.transformOrigin = 'top left';
            container.style.transform = 'scale(' + zoomLevel + ')';
            imageContainer.scrollLeft = 0;
            imageContainer.scrollTop = 0;
        }

        function selectExt(id) {
            var content_id = '#' + id;
            var select = 'bg-success-subtle';

            $('.list-group-item').removeClass(select);
            $(content_id).addClass(select);

            if ($(content_id).hasClass(select)) {
                pointID = parseInt(id);
            } else {
                pointID = 0;
            }

            console.log(pointID);
        }

        function startDragging(event) {
            var point = event.target.closest('.fire-icon');
            var offsetX = event.clientX - parseFloat(point.parentElement.style.left);
            var offsetY = event.clientY - parseFloat(point.parentElement.style.top);

            function movePoint(event) {
                var parentElement = point.parentElement;
                parentElement.style.left = (event.clientX - offsetX) + 'px';
                parentElement.style.top = (event.clientY - offsetY) + 'px';

                var index = points.findIndex(function(p) {
                    return p.element === parentElement;
                });

                if (index !== -1) {
                    points[index].x = parseFloat(parentElement.style.left) + parentElement.offsetWidth / 2;
                    points[index].y = parseFloat(parentElement.style.top) + parentElement.offsetHeight / 2;
                }
            }

            function stopDragging() {
                document.removeEventListener('mousemove', movePoint);
                document.removeEventListener('mouseup', stopDragging);
            }

            document.addEventListener('mousemove', movePoint);
            document.addEventListener('mouseup', stopDragging);
        }

        function setData() {
            devices.map(device => {
                pointID = device.id;
                createPoint(device.x, device.y);
                updateLegend(device.id);
            })
        }

        function createPoint(x, y) {
            var pointElement = document.createElement('div');
            pointElement.id = 'popoverPoint' + pointID;
            pointElement.style.position = 'absolute';
            pointElement.style.left = (x - 12) + 'px';
            pointElement.style.top = (y - 12) + 'px';

            var fireIcon = document.createElement('span');
            fireIcon.className = 'material-symbols-outlined text-danger fs-3 ps-2 fire-icon';
            fireIcon.innerText = 'fire_extinguisher';

            pointElement.appendChild(fireIcon);

            var idText = document.createElement('span');
            idText.innerText = pointID;
            pointElement.appendChild(idText);

            fireIcon.addEventListener('mousedown', startDragging); // Agrega el evento al icono, si es necesario

            container.appendChild(pointElement);

            var newPoint = {
                id: pointID,
                x: x,
                y: y,
                element: pointElement,
            }

            points.push(newPoint);
            updateLegend(pointID);
        }

        function updateLegend(id) {
            var content_id = '#' + id;
            var select = 'bg-success-subtle';
            var unselect = 'bg-secondary-subtle';

            if (points.map(point => point.id).includes(pointID)) {
                $(content_id).removeClass(select);
                $(content_id).addClass(unselect)
                $(content_id).prop("disabled", true);
            }
        }

        function saveData() {
            $('#points').val(JSON.stringify(points));
        }

        zoomRange.addEventListener('input', function() {
            applyZoom();
        });

        document.getElementById('image-container').addEventListener('dblclick', function(event) {
            var zoomLevel = parseFloat(zoomRange.value); // Obtén el nivel de zoom actual.
            var rect = event.target.getBoundingClientRect();
            var offsetX = (event.clientX - rect.left) / zoomLevel; // Ajusta la posición x basándote en el zoom.
            var offsetY = (event.clientY - rect.top) / zoomLevel;
            if (pointID > 0 && !points.map(point => point.id).includes(pointID)) {
                createPoint(offsetX, offsetY);
            }
        });

        $(document).ready(function() {
            img.src = "{{ $imageUrl }}";
            img.onload = function() {
                var width = this.naturalWidth;
                var height = this.naturalHeight;
                imageContainer.style.width = (width * 2) + "px";
                imageContainer.style.height = (height * 2) + "px";
            };
            setData()
        });
    </script>
@endsection
