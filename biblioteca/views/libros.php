<div class="p-4">
  <input id="isbnInput" type="text" placeholder="ISBN" class="border p-2 rounded" />
  <button onclick="consultarDisponibilidad()" class="bg-blue-500 text-white p-2 rounded">Consultar</button>
  <p id="resultado" class="mt-2 text-green-600"></p>
</div>

<script>
function consultarDisponibilidad() {
  const isbn = document.getElementById('isbnInput').value;
  fetch(`/libros/disponibilidad/${isbn}`)
    .then(res => res.json())
    .then(data => {
      document.getElementById('resultado').innerText = data.disponibilidad ? 'Disponible' : 'No disponible';
    });
}
</script>