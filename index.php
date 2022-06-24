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
		    <li class="breadcrumb-item active" aria-current="page">Inicio</li>
		  </ol>
		</nav>

		<div class="row">
			<div class="col-md-12">
				<h4>Usuarios</h4>

				<div class="mt-5">
					<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Nombre</th>
					      <th scope="col">Acción</th>      
					    </tr>
					  </thead>
					  <tbody id="tabla_lista_usuarios">
					    
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Información usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="contenido_modal">
        <div class="row">
		  <div class="col">
		    <label for=""><b>Nombre:</b></label>
		  </div>
		  <div class="col">
		    <span id="nombreUsuario"></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col">
		    <label for=""><b>Username:</b></label>
		  </div>
		  <div class="col">
		    <span id="usernameUsuario"></span>
		  </div>
		</div>
		<div class="row">
		  <div class="col">
		    <label for=""><b>mail:</b></label>
		  </div>
		  <div class="col">
		    <span id="emailUsuario"></span>
		  </div>
		</div>
      </div>
      <br>
      <div class="container" id="div_modal_botones">      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
<script>
	const GetUsers = async () =>{
		const response = await fetch('https://jsonplaceholder.typicode.com/users');
		const usuarios = await response.json();
		
		let tableUser = ``;
		usuarios.forEach((user, index) =>{
			tableUser += `<tr>
		    	<td>${user.id}</td>
		    	<td>${user.name}</td>
		    	<td>
		    		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onClick="GetDataUser(${user.id})"> Ver </button>
				</td>
		    </tr>`;
		});

		tabla_lista_usuarios.innerHTML = tableUser;
	}

	const GetDataUser = async ($id) =>{
		const response = await fetch('https://jsonplaceholder.typicode.com/users/'+$id);
		const usuario = await response.json();
  		

  		document.getElementById('nombreUsuario').innerHTML = usuario.name;
  		document.getElementById('usernameUsuario').innerHTML = usuario.username;
  		document.getElementById('emailUsuario').innerHTML = usuario.email;

  		let divBotones = `<div class="container mb-3" style="text-align = center">		
			<a href="posts/?idUsuario=${usuario.id}" class="btn btn-info"> Posts</a>
			<a href="todos/?idUsuario=${usuario.id}" class="btn btn-success"> Tareas</a>
		</div>`;

      	div_modal_botones.innerHTML = divBotones;

	}	
  GetUsers();
</script>