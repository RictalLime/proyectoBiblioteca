<div class="p-4 max-w-md mx-auto">
  <h2 class="text-xl font-bold mb-4">Registro de Usuario</h2>
  <input id="nombre" type="text" placeholder="Nombre" class="w-full mb-2 border p-2 rounded" />
  <input id="correo" type="email" placeholder="Correo" class="w-full mb-2 border p-2 rounded" />
  <input id="contrasena" type="password" placeholder="Contraseña" class="w-full mb-2 border p-2 rounded" />
  <input id="matricula" type="text" placeholder="Matrícula" class="w-full mb-2 border p-2 rounded" />
  <button onclick="registrarUsuario()" class="bg-green-500 text-white p-2 rounded w-full">Registrar</button>
  <p id="resultadoUsuario" class="mt-2 text-green-600"></p>
</div>

<script>
function registrarUsuario() {
  const data = {
    nombre: document.getElementById('nombre').value,
    correo: document.getElementById('correo').value,
    contrasena: document.getElementById('contrasena').value,
    matricula: document.getElementById('matricula').value
  };

  fetch('/usuarios', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
  .then(res => res.json())
  .then(result => {
    document.getElementById('resultadoUsuario').innerText = result ? 'Usuario registrado con éxito' : 'Error al registrar';
  });
}
</script>