<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Registro Evento</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      font-family: 'poppins', sans-serif;
      font-size: 14px;
      background: #f8f8f8;
      margin: 0;
      padding: 0;
    }
    label,
    input,
    select,
    button,
    textarea,
    .multi-select-container {
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
    }

    .container {
      max-width: 700px;
      margin: auto;
      background: #fff;
      padding: 20px 30px;
    }

    header {
      max-width: 700px;
      margin: 20px auto 0 auto;
      background-color: #ff6600;
      color: white;
      padding: 15px;
      text-align: center;
      position: relative;
      font-size: 18px;
      font-weight: bold;
      border-radius: 6px 6px 0 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .back-button {
      position: absolute;
      left: 20px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 24px;
      color: white;
      padding: 5px;
      border-radius: 4px;
    }
    .back-button:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    .logo {
      height: 50px;
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
    }

    label {
      font-weight: bold;
      margin-bottom: 6px;
      display: inline-block;
    }

    .section {
      margin-bottom: 20px;
    }

    input,
    textarea,
    select {
      width: 100%;
      margin-bottom: 10px;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
    }

    textarea {
      resize: vertical;
      min-height: 80px;
    }

    .image-upload {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
      margin: 10px 0;
      justify-content: flex-start;
      align-items: flex-start;
      width: 100%;
    }

    .image-upload > div {
      width: 150px;
      height: 100px;
      border: 1px solid #ccc;
      border-radius: 8px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: #fff;
      cursor: pointer;
      overflow: hidden;
      position: relative;
      padding: 5px;
      box-sizing: border-box;
      flex-shrink: 0;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .image-upload > div:hover {
        background-color: #f9f9f9;
    }

    .image-upload .bi-image {
      font-size: 48px;
      color: #999;
    }

    .image-upload .upload-text {
        display: none;
    }

    .image-upload .loaded-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 6px;
        position: absolute;
        top: 0;
        left: 0;
    }

    .image-upload .fa-times-circle {
        position: absolute;
        top: 5px;
        right: 5px;
        color: red;
        cursor: pointer;
        font-size: 18px;
        background-color: white;
        border-radius: 50%;
        z-index: 10;
        padding: 2px;
        box-shadow: 0 0 3px rgba(0,0,0,0.3);
    }

    small {
      display: block;
      color: #000;
      opacity: 0.5;
      margin-bottom: 8px;
      font-size: 13px;
    }

    .add-btn,
    .average-btn {
      background-color: #ff6600;
      color: white;
      border: none;
      padding: 7px 14px;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 10px;
      font-size: 14px;
    }

    .multi-select-container,
    .single-select-container {
      position: relative;
      width: fit-content;
      margin-top: 5px;
    }

    .multi-select-header,
    .single-select-header {
      border: 1px solid #ccc;
      padding: 8px 12px;
      border-radius: 6px;
      background: #fff;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      min-height: 20px;
      width: fit-content;
      min-width: 200px;
      max-width: 300px;
    }

    .multi-select-options,
    .single-select-options {
      display: none;
      position: absolute;
      width: fit-content;
      min-width: 200px;
      max-width: 300px;
      border: 1px solid #ccc;
      border-top: none;
      background: #fff;
      z-index: 100;
      max-height: 150px;
      overflow-y: auto;
      border-radius: 0 0 6px 6px;
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .multi-select-option,
    .single-select-option {
      padding: 6px 12px;
      cursor: pointer;
      position: relative;
      padding-left: 25px;
    }

    .multi-select-option:before,
    .single-select-option:before {
      content: "•";
      position: absolute;
      left: 10px;
      color: #ff6600;
    }

    .multi-select-option.selected,
    .single-select-option.selected {
      background-color: #ff6600;
      color: white;
    }

    .multi-select-option.selected:before,
    .single-select-option.selected:before {
      color: white;
    }

    .multi-select-option:hover:not(.selected),
    .single-select-option:hover:not(.selected) {
      background-color: #f5f5f5;
    }

    .multi-select-container.open .multi-select-options,
    .single-select-container.open .single-select-options {
      display: block;
    }

    .selected-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 5px;
      margin-top: 5px;
    }

    .selected-tag {
      background: #ff6600;
      color: white;
      padding: 3px 8px;
      border-radius: 12px;
      font-size: 12px;
      display: flex;
      align-items: center;
    }

    .selected-tag i {
      margin-left: 5px;
      cursor: pointer;
      font-size: 10px;
    }

    .single-select-tag {
      background: #ff6600;
      color: white;
      padding: 3px 8px;
      border-radius: 12px;
      font-size: 12px;
      display: inline-flex;
      align-items: center;
      margin-top: 5px;
    }

    .single-select-tag i {
      margin-left: 5px;
      cursor: pointer;
      font-size: 10px;
    }

    .date-input-wrapper {
      display: flex;
      align-items: center;
      border: 1px solid #ccc;
      border-radius: 6px;
      padding: 4px 10px;
      margin-bottom: 10px;
      background-color: #fff;
    }

    .date-input-wrapper input[type="date"] {
      border: none;
      outline: none;
      flex: 1;
      padding: 0;
      margin-bottom: 0;
      background: transparent;
      text-align: left;
      margin-right: 8px;

      -webkit-appearance: none !important;
      -moz-appearance: none !important;
      appearance: none !important;
      background-image: none !important;

      &::-webkit-inner-spin-button,
      &::-webkit-calendar-picker-indicator {
          display: none !important;
          -webkit-appearance: none !important;
      }
    }

    .date-input-wrapper .bi-calendar3 {
      margin-left: auto;
      color: #555;
      font-size: 18px;
      cursor: pointer;
    }

    .date-group {
      display: flex;
      gap: 60px;
      margin-top: 6px;
      margin-bottom: 10px;
      align-items: flex-start;
    }

    .date-picker {
      display: flex;
      flex-direction: column;
      width: 180px;
    }

    .service-row {
      display: flex;
      gap: 10px;
      margin-bottom: 10px;
    }

    .service-row input {
      flex: 1;
      font-size: 14px;
      padding: 8px 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .service-row button {
      background-color: #ff6600;
      color: white;
      border: none;
      padding: 0 10px;
      border-radius: 4px;
      cursor: pointer;
    }

    .service-buttons {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 10px;
      align-items: flex-start;
    }

    .submit-buttons {
      display: flex;
      gap: 15px;
      margin-top: 25px;
      justify-content: center;
      width: 100%;
    }

    .submit-buttons button {
      flex-grow: 0;
      flex-shrink: 0;
      width: 140px;
      padding: 8px 15px;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      font-weight: bold;
      font-size: 15px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .submit-buttons .publish {
      background-color: #ff6600;
      color: white;
      border: 1px solid #ff6600;
    }

    .submit-buttons .cancel {
      background-color: #fff;
      color: #ff6600;
      border: 1px solid #ff6600;
    }

    .average {
      color: black;
      font-weight: bold;
      margin-top: 10px;
    }

    .average-price {
      color: orange;
    }

    input[type="file"] {
      display: none;
    }
  </style>
</head>
<body>
 <header>
    <i class="fas fa-arrow-left back-button" onclick="goBack()"></i>
    Modificar evento
    <img src="{{ asset('img/parchatelogo.png') }}" alt="Logo" class="logo" />
</header>

<form id="eventoForm" method="POST" action="{{ route('eventos.update', $evento->id_evento) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container">
        <div class="section">
            <label>Nombre del evento</label>
            <input type="text" id="nombreEvento" name="nombre_evento" value="{{ $evento->nombre_evento }}" placeholder="Ingrese el nombre del evento" />
        </div>

        <div class="section">
            <label>Descripción del evento</label>
            <textarea id="descripcionEvento" name="descripcion_evento" placeholder="Describe tu evento">{{ $evento->descripcion_evento }}</textarea>
        </div>

        <div class="section">
            <label>Imágenes de su sucursal</label>
            <small>Ten en cuenta que el orden en que subas las imágenes será el orden en que las mostraremos</small>
            <div class="image-upload" id="imagePreview">
    @for ($i = 0; $i < 4; $i++)
        @php
            $imagen = $evento->imagenes[$i] ?? null;
        @endphp
        <div id="imageSlot{{ $i }}">
            @if ($imagen)
                <img src="{{ asset('storage/' . $imagen->ruta_imagen_evento) }}" alt="Imagen del evento" class="loaded-image" />
            @else
                <i class="bi bi-image"></i>
            @endif
        </div>
    @endfor
</div>

            <button class="add-btn" type="button" onclick="document.getElementById('fileUpload').click()">Subir fotos</button>
            <input type="file" id="fileUpload" name="imagenes[]" multiple accept="image/*" onchange="handleImageUpload(event)" />
        </div>

        <div class="section small-section">
            <label class="small-label">Selecciona las etiquetas del tipo de evento</label>
            <div class="multi-select-container small-select" id="eventTypeSelect">
                <div class="multi-select-header" onclick="toggleMultiSelect('eventTypeSelect')">
                    Seleccionar etiquetas <i class="fas fa-chevron-down"></i>
                </div>
                <ul class="multi-select-options">
                    @php
                        $etiquetasSeleccionadas = json_decode($evento->etiquetas) ?? [];

                    @endphp
                    @foreach(['Entretenimiento', 'Gastronomía', 'Salud', 'Cultural', 'Bienestar', 'Familiar', 'Social'] as $etiqueta)
                        <li class="multi-select-option {{ in_array($etiqueta, $etiquetasSeleccionadas) ? 'selected' : '' }}" onclick="toggleMultiOption(this, 'eventTypeSelect')">{{ $etiqueta }}</li>
                    @endforeach
                </ul>
                <div class="selected-tags" id="selectedEventTypes">
                    @foreach($etiquetasSeleccionadas as $etiqueta)
                        <div class="selected-tag">
                            {{ $etiqueta }} <i class="fas fa-times" onclick="removeMultiSelection(this, 'eventTypeSelect')"></i>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="section">
            <div class="date-group">
                <div class="date-picker">
                    <label for="fechaInicio">Fecha inicio del evento</label>
                    <div class="date-input-wrapper">
                        <input id="fechaInicio" type="date" name="fecha_inicio_evento" value="{{ $evento->fecha_inicio_evento }}" />
                        <i class="bi bi-calendar3" onclick="openDatePicker('fechaInicio')"></i>
                    </div>
                </div>

                <div class="date-picker">
                    <label for="fechaFin">Fecha fin del evento</label>
                    <div class="date-input-wrapper">
                        <input id="fechaFin" type="date" name="fecha_fin_evento" value="{{ $evento->fecha_fin_evento }}" />
                        <i class="bi bi-calendar3" onclick="openDatePicker('fechaFin')"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <label>Selecciona las etiquetas de horarios del evento</label>
            <div class="single-select-container" id="eventTimeSelect">
                <div class="single-select-header" onclick="toggleSingleSelect('eventTimeSelect')">
                    Seleccionar horarios <i class="fas fa-chevron-down"></i>
                </div>
                <ul class="single-select-options">
                    @foreach(['20:00', '21:00', '22:00', '23:00', '00:00', '01:00', '02:00'] as $hora)
                        <li class="single-select-option {{ $evento->hora_inicio_evento == $hora ? 'selected' : '' }}" onclick="selectSingleOption(this, 'eventTimeSelect')">{{ $hora }}</li>
                    @endforeach
                </ul>
                <div class="single-select-tag" id="selectedEventTime" style="{{ $evento->hora_inicio_evento ? 'display:inline-flex;' : 'display:none;' }}">
                    {{ $evento->hora_inicio_evento }} <i class="fas fa-times" onclick="removeSingleSelection('eventTimeSelect')"></i>
                </div>
            </div>
        </div>

        <div class="section">
            <label>Ingrese el producto o servicio y el precio</label>
            <div id="service-container">
                @foreach($evento->productos ?? [] as $producto)
                    <div class="service-row">
                        <input type="text" placeholder="Ingrese el producto o servicio" name="productos[]" value="{{ $producto->nombre }}" />
                        <input type="number" placeholder="Precio" class="price-input" min="0" name="precios[]" value="{{ $producto->precio }}" />
                        <button type="button" onclick="removeService(this)" style="display: {{ $index == 0 ? 'none' : 'block' }};">−</button>
                    </div>
                @endforeach
            </div>
            <div class="service-buttons">
                <button class="add-btn" type="button" onclick="addService()">+</button>
                <button class="average-btn" type="button" onclick="calculateAverage()">Realizar promedio</button>
            </div>
            <p class="average">Promedio del precio para los usuarios: <span id="average-price" class="average-price">$000.0</span></p>
        </div>

        <div class="section">
            <label>Ubicación sucursal del evento</label>
            <input type="text" id="ubicacionEvento" name="ubicacion_dada_evento" value="{{ $evento->ubicacion_dada_evento }}" placeholder="Ingrese la ubicación de la sucursal del evento" />
        </div>

        <!-- Campos ocultos para etiquetas y horario -->
        <input type="hidden" name="etiquetas" id="inputEtiquetas" value="{{ $evento->etiquetas }}" />
        <input type="hidden" name="hora_inicio_evento" id="inputHorario" value="{{ $evento->hora_inicio_evento }}" />

        <div class="section submit-buttons">
            <button type="button" class="publish" onclick="submitForm()">Actualizar</button>
            <button type="button" class="cancel" onclick="goBack()">Cancelar</button>
        </div>
    </div>
</form>

  <script>
    function goBack() {
      window.history.back();
    }

    function openDatePicker(inputId) {
      document.getElementById(inputId).showPicker();
    }

    function toggleMultiSelect(id) {
      document.getElementById(id).classList.toggle("open");
      event.stopPropagation();
    }

    function toggleSingleSelect(id) {
      document.getElementById(id).classList.toggle("open");
      event.stopPropagation();
    }

    document.addEventListener('click', function(event) {
      const dropdowns = document.querySelectorAll('.multi-select-container, .single-select-container');
      dropdowns.forEach(dropdown => {
        if (!dropdown.contains(event.target)) {
          dropdown.classList.remove("open");
        }
      });
    });

    function toggleMultiOption(element, dropdownId) {
      element.classList.toggle("selected");
      updateSelectedTags(dropdownId);
      event.stopPropagation();
    }

    function selectSingleOption(element, dropdownId) {
      const dropdown = document.getElementById(dropdownId);
      const options = dropdown.querySelectorAll('.single-select-option');

      options.forEach(opt => opt.classList.remove("selected"));

      element.classList.add("selected");
      updateSingleSelectedTag(dropdownId, element.textContent);

      dropdown.classList.remove("open");

      event.stopPropagation();
    }

    function updateSelectedTags(dropdownId) {
      const dropdown = document.getElementById(dropdownId);
      const selectedContainer = dropdown.querySelector(".selected-tags");
      const selectedItems = dropdown.querySelectorAll(".multi-select-option.selected");

      selectedContainer.innerHTML = '';

      selectedItems.forEach(item => {
        const tag = document.createElement("div");
        tag.className = "selected-tag";
        tag.innerHTML = `${item.textContent} <i class="fas fa-times" onclick="removeMultiSelection(this, '${dropdownId}')"></i>`;
        selectedContainer.appendChild(tag);
      });
    }

    function updateSingleSelectedTag(dropdownId, value) {
      const selectedContainer = document.getElementById("selectedEventTime");

      if (value) {
        selectedContainer.innerHTML = `${value} <i class="fas fa-times" onclick="removeSingleSelection('${dropdownId}')"></i>`;
        selectedContainer.style.display = "inline-flex";
      } else {
        selectedContainer.innerHTML = "";
        selectedContainer.style.display = "none";
      }
    }

    function removeMultiSelection(icon, dropdownId) {
      const itemText = icon.parentNode.textContent.trim();
      const dropdown = document.getElementById(dropdownId);
      const items = dropdown.querySelectorAll(".multi-select-option");

      items.forEach(item => {
        if(item.textContent.trim() === itemText) {
          item.classList.remove("selected");
        }
      });

      updateSelectedTags(dropdownId);
      event.stopPropagation();
    }

    function removeSingleSelection(dropdownId) {
      const dropdown = document.getElementById(dropdownId);
      const selectedOption = dropdown.querySelector(".single-select-option.selected");

      if (selectedOption) {
        selectedOption.classList.remove("selected");
      }

      updateSingleSelectedTag(dropdownId, null);
      event.stopPropagation();
    }

    function addService() {
      const container = document.getElementById("service-container");
      const row = document.createElement("div");
      row.className = "service-row";

      const input1 = document.createElement("input");
      input1.placeholder = "Ingrese el producto o servicio";

      const input2 = document.createElement("input");
      input2.placeholder = "Precio";
      input2.type = "number";
      input2.className = "price-input";
      input2.min = "0";

      const delBtn = document.createElement("button");
      delBtn.textContent = "−";
      delBtn.className = "btn btn-danger";
      delBtn.onclick = (event) => {
        removeService(event.target);
      };
      // Initially hide the button, visibility will be managed by updateRemoveButtonsVisibility
      delBtn.style.display = 'none';

      row.appendChild(input1);
      row.appendChild(input2);
      row.appendChild(delBtn);
      container.appendChild(row);

      updateRemoveButtonsVisibility(); // Call after adding a service
    }

    function removeService(buttonElement) {
      const row = buttonElement.closest('.service-row');
      if (row) {
        row.remove();
        updateRemoveButtonsVisibility(); // Call after removing a service
      }
    }

    function updateRemoveButtonsVisibility() {
      const serviceRows = document.querySelectorAll("#service-container .service-row");
      const removeButtons = document.querySelectorAll("#service-container .service-row button");

      if (serviceRows.length <= 1) {
        removeButtons.forEach(button => button.style.display = 'none');
      } else {
        removeButtons.forEach(button => button.style.display = 'block');
      }
    }

    function calculateAverage() {
      const prices = Array.from(document.querySelectorAll(".price-input"))
        .map((input) => parseFloat(input.value) || 0)
        .filter((val) => val >= 0);
      const avg = prices.length
        ? (prices.reduce((a, b) => a + b, 0) / prices.length).toFixed(2)
        : "000.0";
      document.getElementById("average-price").textContent = `$${avg}`;
    }

    let currentImages = [null, null, null, null];
    const MAX_IMAGES = 4;

    function handleImageUpload(event) {
        const files = Array.from(event.target.files);
        event.target.value = '';

        let filesToProcess = files.slice(0, MAX_IMAGES);

        let currentFileIndex = 0;

        for (let i = 0; i < MAX_IMAGES && currentFileIndex < filesToProcess.length; i++) {
            if (currentImages[i] === null) {
                currentImages[i] = filesToProcess[currentFileIndex];
                renderImageSlot(document.getElementById(`imageSlot${i}`), currentImages[i], i);
                currentFileIndex++;
            }
        }

        if (currentFileIndex < filesToProcess.length) {
            let replaceStartIndex = 0;
            while (currentFileIndex < filesToProcess.length) {
                currentImages[replaceStartIndex] = filesToProcess[currentFileIndex];
                renderImageSlot(document.getElementById(`imageSlot${replaceStartIndex}`), currentImages[replaceStartIndex], replaceStartIndex);
                currentFileIndex++;
                replaceStartIndex = (replaceStartIndex + 1) % MAX_IMAGES;
            }
        }
    }

    function renderImageSlot(slotElement, file, index) {
        slotElement.innerHTML = '';

        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = "Imagen subida";
                img.className = 'loaded-image';

                const closeIcon = document.createElement('i');
                closeIcon.className = 'fas fa-times-circle';
                closeIcon.onclick = (event) => {
                    event.stopPropagation();
                    removeImage(index);
                };

                slotElement.appendChild(img);
                slotElement.appendChild(closeIcon);

                slotElement.style.border = 'none';
                slotElement.style.cursor = 'default';
                slotElement.onclick = null;
            };
            reader.readAsDataURL(file);
        } else {
            const icon = document.createElement('i');
            icon.className = 'bi bi-image';

            slotElement.appendChild(icon);

            slotElement.style.border = '1px solid #ccc';
            slotElement.style.cursor = 'pointer';
            slotElement.onclick = () => document.getElementById('fileUpload').click();
        }
    }

    function removeImage(index) {
        currentImages[index] = null;
        const slotElement = document.getElementById(`imageSlot${index}`);
        renderImageSlot(slotElement, null, index);
    }

    function submitForm() {
    const selectedEventTypes = Array.from(document.querySelectorAll("#eventTypeSelect .multi-select-option.selected"))
        .map(item => item.textContent.trim());

    const selectedEventTime = document.querySelector("#eventTimeSelect .single-select-option.selected")?.textContent.trim() || null;

    // Pasar los valores a los inputs ocultos
    document.getElementById('inputEtiquetas').value = JSON.stringify(selectedEventTypes);
    document.getElementById('inputHorario').value = selectedEventTime;

    // Enviar el formulario después de llenar los campos ocultos
    document.getElementById('eventoForm').submit();
}

    document.addEventListener('DOMContentLoaded', function() {
      updateSingleSelectedTag('eventTimeSelect', null);

      for(let i = 0; i < MAX_IMAGES; i++) {
          renderImageSlot(document.getElementById(`imageSlot${i}`), null, i);
      }
      updateRemoveButtonsVisibility(); // Initial check for remove buttons
    });
  </script>
</body>
</html>