<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localidades de Venezuela</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4 text-center">Selector de Localidades de Venezuela</h1>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="estado" class="form-label">Estado:</label>
                <select id="estado" name="estado" class="form-select">
                    <option value="">Seleccione un Estado</option>
                    <?php if (!empty($estados)): ?>
                        <?php foreach ($estados as $estado): ?>
                            <option value="<?php echo $estado['id_estado']; ?>"><?php echo htmlspecialchars($estado['estado']); ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="col-md-6">
                <label for="ciudad" class="form-label">Ciudad:</label>
                <select id="ciudad" name="ciudad" class="form-select" disabled>
                    <option value="">Seleccione una Ciudad</option>
                </select>
                <!-- Hidden field to store the state_id of the selected city -->
                <input type="hidden" id="ciudad_estado_id" name="ciudad_estado_id">
            </div>

            <div class="col-md-6">
                <label for="municipio" class="form-label">Municipio:</label>
                <select id="municipio" name="municipio" class="form-select" disabled>
                    <option value="">Seleccione un Municipio</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="parroquia" class="form-label">Parroquia:</label>
                <select id="parroquia" name="parroquia" class="form-select" disabled>
                    <option value="">Seleccione una Parroquia</option>
                </select>
            </div>
        </div>
    </div>

    <!-- jQuery (ensure it's loaded before your script) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var base_url = "<?php echo base_url(); ?>";

            // Function to reset and disable dropdowns
            function resetDropdown(dropdownId, defaultOptionText) {
                $(dropdownId).empty().append('<option value="">' + defaultOptionText + '</option>').prop('disabled', true);
            }

            $('#estado').change(function() {
                var estado_id = $(this).val();
                resetDropdown('#ciudad', 'Seleccione una Ciudad');
                resetDropdown('#municipio', 'Seleccione un Municipio');
                resetDropdown('#parroquia', 'Seleccione una Parroquia');
                $('#ciudad_estado_id').val('');


                if (estado_id) {
                    // Fetch Ciudades
                    $.ajax({
                        url: base_url + 'index.php/welcome/get_ciudades',
                        method: 'POST',
                        data: {estado_id: estado_id},
                        dataType: 'json',
                        success: function(data) {
                            $('#ciudad').prop('disabled', false);
                            if (data.length > 0) {
                                $.each(data, function(key, value) {
                                    $('#ciudad').append('<option value="' + value.id_ciudad + '" data-estado-id="' + value.id_estado + '">' + value.ciudad + '</option>');
                                });
                            } else {
                                $('#ciudad').append('<option value="">No hay ciudades disponibles</option>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching ciudades: " + error);
                            alert("Error al cargar las ciudades.");
                        }
                    });

                    // Fetch Municipios for the selected state (as per schema and user request workaround)
                    // This happens when state changes, as municipalities depend on state
                    $.ajax({
                        url: base_url + 'index.php/welcome/get_municipios',
                        method: 'POST',
                        data: {estado_id: estado_id}, // Municipalities are fetched by state_id
                        dataType: 'json',
                        success: function(data) {
                             // Municipios dropdown is enabled by city selection, but populated here based on state.
                             // If a city is selected later, this list is already filtered by state.
                            if (data.length > 0) {
                                $.each(data, function(key, value) {
                                    $('#municipio').append('<option value="' + value.id_municipio + '">' + value.municipio + '</option>');
                                });
                            } else {
                                $('#municipio').append('<option value="">No hay municipios disponibles para este estado</option>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching municipios: " + error);
                            alert("Error al cargar los municipios.");
                        }
                    });


                }
            });

            $('#ciudad').change(function() {
                var ciudad_id = $(this).val();
                var estado_id_of_city = $(this).find(':selected').data('estado-id');

                resetDropdown('#municipio', 'Seleccione un Municipio'); // Reset municipios first
                resetDropdown('#parroquia', 'Seleccione una Parroquia');

                if (ciudad_id && estado_id_of_city) {
                    // Populate/filter municipios based on the city's state
                    // The municipios are already fetched when state changes, but we re-populate here
                    // to ensure the dropdown is enabled and correctly shows options for the city's state.
                    $('#municipio').prop('disabled', false); // Enable municipio dropdown

                    // We need to re-fetch or filter municipios for the state of the selected city.
                    // For simplicity, let's re-fetch. An alternative would be to store and filter.
                    $.ajax({
                        url: base_url + 'index.php/welcome/get_municipios',
                        method: 'POST',
                        data: {estado_id: estado_id_of_city},
                        dataType: 'json',
                        success: function(data) {
                            resetDropdown('#municipio', 'Seleccione un Municipio'); // Clear previous options
                            $('#municipio').prop('disabled', false);
                            if (data.length > 0) {
                                $.each(data, function(key, value) {
                                    $('#municipio').append('<option value="' + value.id_municipio + '">' + value.municipio + '</option>');
                                });
                            } else {
                                $('#municipio').append('<option value="">No hay municipios disponibles</option>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching municipios for city's state: " + error);
                            alert("Error al cargar los municipios.");
                        }
                    });

                } else {
                     $('#municipio').prop('disabled', true);
                }
            });

            $('#municipio').change(function() {
                var municipio_id = $(this).val();
                resetDropdown('#parroquia', 'Seleccione una Parroquia');

                if (municipio_id) {
                    $.ajax({
                        url: base_url + 'index.php/welcome/get_parroquias',
                        method: 'POST',
                        data: {municipio_id: municipio_id},
                        dataType: 'json',
                        success: function(data) {
                            $('#parroquia').prop('disabled', false);
                            if (data.length > 0) {
                                $.each(data, function(key, value) {
                                    $('#parroquia').append('<option value="' + value.id_parroquia + '">' + value.parroquia + '</option>');
                                });
                            } else {
                                $('#parroquia').append('<option value="">No hay parroquias disponibles</option>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching parroquias: " + error);
                             alert("Error al cargar las parroquias.");
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
