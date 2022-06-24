<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="../">Inicio</a></li>
		    <li class="breadcrumb-item active" aria-current="page">Tareas</li>
		  </ol>
		</nav>
		<div class="row">
			<div class="col-md-8">
				<h4>Tareas</h4>

				<div class="mt-5">
					<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">id</th>
					      <th scope="col">Tarea</th>
					      <th scope="col">Completed</th>		      
					    </tr>
					  </thead>
					  <tbody id="tabla_lista_tareas">
					    		    
					  </tbody>
					</table>
				</div>
				

			</div>
			<div class="col-md-4">
				<h4>Crear nueva tarea</h4>
				<div class="row mt-5">
					<div class="mb-3">
					  <label for="titulo_tarea" class="form-label">Título</label>
					  <input type="text" class="form-control" id="titulo_tarea" required>
					</div>
					<div class="mb-3">
					   <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
					  <label class="form-check-label" for="flexCheckDefault">
					    Completed
					  </label>
					</div>
					<button type="button" class="btn btn-secondary" onclick="GuardarDatos();">Enviar</button>
				</div>
				<div id="respuestaForm" class="mt-3">					
				</div>
			</div>
		</div>
		
	</div>
	
</body>
</html>

<script>
	var queryString = window.location.search;
	var urlParams = new URLSearchParams(queryString);
	var idUsuario = urlParams.get('idUsuario');

	const GetTareasUser	 = async ($id) =>{
		const response = await fetch('https://jsonplaceholder.typicode.com/users/'+$id+'/todos');
		const tareas = await response.json();
		
		let tableTareas = ``;
		tareas.slice().reverse().forEach((tarea, index) =>{
			tableTareas +=`<tr>
		      <th scope="row">${tarea.id}</th>
		      <td>${tarea.title}</td>
		      <td>${tarea.completed}</td>
		    </tr>`;	
		});

		tabla_lista_tareas.innerHTML = tableTareas;
	}

	GetTareasUser(idUsuario);

	function GuardarDatos(){
		var titulo = document.getElementById('titulo_tarea').value;
		if (document.getElementById('flexCheckDefault').checked) {
			var completado = true;
		}else{
			var completado = false;
		}
		
		if (titulo != '') {			
			fetch('https://jsonplaceholder.typicode.com/users/'+idUsuario+'/todos', {
				method: 'POST',
				body: JSON.stringify({
					title: titulo,
					completed: completado,				
				}),
				headers: {
					'Content-type': 'application/json; charset=UTF-8',
				},
			})
			.then((response) => response.json())
			.then((json) => {
				console.log(json);
				respuestaForm.innerHTML = `<div class="alert alert-success" role="alert">
					  Tarea creada correctamente
					</div>`;				
			});
		}else{
			respuestaForm.innerHTML = `<div class="alert alert-danger" role="alert">
					  Error: ingresar título
					</div>`;
		}
	}
</script>