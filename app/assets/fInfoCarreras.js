const facultadSelect = document.getElementById('facultad');
const departamentoSelect = document.getElementById('departamento');

const departamentos = {
    'Facultad de Ingenierías': [
        'Departamento de Ingeniería Mecánica',
        'Departamento de Ingeniería de Alimentos',
        'Departamento de Ingeniería Industrial',
        'Departamento de Ingeniería Ambiental',
        'Departamento de Ingeniería de Sistemas'
    ],
    'Facultad de Medicina Veterinaria y Zootecnia': [
        'Ciencias Pecuarias',
        'Ciencias Acuícolas'
    ],
    'Facultad de Ciencias Agrícolas': [
        'Ingeniería Agronómica y Desarrollo Rural'
    ],
    'Facultad de Ciencias Básicas': [
        'Departamento de Química',
        'Departamento de Geografía y Medio Ambiente',
        'Departamento de Biología',
        'Departamento de Física y Electrónica',
        'Departamento de Matemáticas y Estadística'

    ],
    'Facultad de Educación y Ciencias Humanas': [
        'Departamento de Informática',
        'Departamento de Ciencias Sociales',
        'Departamento de Educación Artística',
        'Departamento de Educación Infantil',
        'Departamento de Ciencias Naturales y Eduación Ambiental',
        'Departamento de Licenciatura y Lengua Castellana',
        'Departamento de Educación Física, Recreación y Deportes',
        'Departamento de Lenguas Extranjeras con Enfasis en Inglés'
    ],
    'Facultad de Ciencias Económicas, Jurídicas y Administrativas': [
        'Departamento de Economía',
        'Departamento de Derecho',
        'Departamento de Administración'
    ],
    'Facultad de Ciencias de la Salud': [
        'Departamento de Administración en Salud',
        'Departamento de Bacteriología',
        'Departamento de Enfermería'
    ]
};

facultadSelect.addEventListener('change', function () {
    departamentoSelect.disabled = false;
    const facultadSeleccionada = facultadSelect.value;
    departamentoSelect.innerHTML = '<option disabled selected value>Selecciona tu departamento</option>';

    if (departamentos[facultadSeleccionada]) {
        departamentos[facultadSeleccionada].forEach(departamento => {
            const option = document.createElement('option');
            option.value = departamento;
            option.textContent = departamento;
            departamentoSelect.appendChild(option);
        });
    }
});