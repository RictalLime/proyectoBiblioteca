<div class="p-4 max-w-md mx-auto">
  <h2 class="text-xl font-bold mb-4">Registrar Préstamo</h2>
  <input id="usuario_id" type="number" placeholder="ID Usuario" class="w-full mb-2 border p-2 rounded" />
  <input id="isbn" type="text" placeholder="ISBN del Libro" class="w-full mb-2 border p-2 rounded" />
  <button onclick="registrarPrestamo()" class="bg-indigo-500 text-white p-2 rounded w-full">Prestar</button>
  <p id="resultadoPrestamo" class="mt-2 text-green-600"></p>
</div>

<script>
function registrarPrestamo() {
  const data = {
    usuario_id: parseInt(document.getElementById('usuario_id').value),
    isbn: document.getElementById('isbn').value
  };

  fetch('/prestamos', {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
  .then(res => res.json())
  .then(result => {
    document.getElementById('resultadoPrestamo').innerText = result ? 'Préstamo registrado' : 'Error al registrar';
  });
}
</script>