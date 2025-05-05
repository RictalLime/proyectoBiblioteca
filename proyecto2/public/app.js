async function cargarLibros() {
    console.log("Intentando cargar libros...");

    try {
        const response = await fetch('http://localhost:8080/api/libro.php');
        if (!response.ok) {
            throw new Error(`Error en API: ${response.status}`);
        }

        const data = await response.json();
        console.log("Datos recibidos:", data);

        // Acceder correctamente a "data.datos"
        const libros = data.datos;

        // Verificar si "libros" es un array antes de usar forEach()
        if (!Array.isArray(libros)) {
            console.error("Error: 'datos' no es un array. Revisa la estructura del JSON.");
            return;
        }

        console.log("Lista de libros obtenida:", libros); // Confirmación en consola

        const lista = document.getElementById('listaLibros');
        if (!lista) {
            console.error("Elemento listaLibros no encontrado en el HTML");
            return;
        }

        lista.innerHTML = '<li>Cargando libros...</li>'; // Mensaje temporal

        setTimeout(() => {
            lista.innerHTML = ''; // Limpiar mensaje temporal
            libros.forEach(libro => {
                console.log(`Agregando libro: ${libro.titulo} - ${libro.autor}`);
                const li = document.createElement('li');
                li.textContent = `${libro.titulo} - ${libro.autor}`;
                lista.appendChild(li);
            });
        }, 500);

    } catch (error) {
        console.error("Error al obtener los libros:", error);
    }
}