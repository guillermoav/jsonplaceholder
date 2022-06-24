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
		    <li class="breadcrumb-item active" aria-current="page">Posts</li>
		  </ol>
		</nav>
		<div class="row">
			<div class="col-md-8">
				<h4>Posts</h4>

				<div class="mt-5">
					<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">id</th>
					      <th scope="col">Título</th>
					      <th scope="col">Acción</th>		      
					    </tr>
					  </thead>
					  <tbody id="tabla_lista_posts">
					    		    
					  </tbody>
					</table>
				</div>
			</div>
			<div class="col-md-4">
				<h4>Comentarios post</h4>
				<div class="row mt-5" id="contenido_comments"  style="height:100vh; overflow: scroll;">
					
				</div>
			</div>
	<div class="container">
		<div class="row" id="listado_posts">
			


		</div>
	</div>	
</body>
</html>
<script>
	var queryString = window.location.search;
	var urlParams = new URLSearchParams(queryString);
	var idUsuario = urlParams.get('idUsuario');

	const GetPostsUser	 = async ($id) =>{
		const response = await fetch('https://jsonplaceholder.typicode.com/users/'+$id+'/posts');
		const posts = await response.json();
		
		let tablePosts = ``;
		posts.forEach((apost, index) =>{
			tablePosts += `
				<tr>
		      <th scope="row">${apost.id}</th>
		      <td>${apost.title}</td>
		      <td><button type="button" class="btn btn-primary" onClick="GetDataComments(${apost.id})"> Comentarios </button></td>
		    </tr>`;
		});
		

		tabla_lista_posts.innerHTML = tablePosts;
	}

	const GetDataComments = async ($id) =>{
		const response = await fetch('https://jsonplaceholder.typicode.com/post/'+$id+'/comments');
		const comments = await response.json();
  		
  		let tablePostComments = `<div class="mb-3"><h5 class="card-title"> Post - ${$id}</h5> </div>`;
		comments.forEach((comment, index) =>{
			tablePostComments += `				
				<div class="col-md-12 mb-5">				
					<div class="card" style="">
					  <div class="card-body">
					    <h5 class="card-title"> ${comment.name}</h5>
					    <h6 class="card-subtitle mb-2 text-muted"> ${comment.email}</h6>				    
					    <p class="card-text"> ${comment.body}</p>					   
					  </div>
					</div>
				</div>`;
		});

		contenido_comments.innerHTML = tablePostComments;
	}
GetPostsUser(idUsuario);
</script>