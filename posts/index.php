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
		<div class="row" id="listado_posts">
			


		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel"></h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body" >
	        <div class="row" id="contenido_modal">
			</div>	  
	      </div>
	      <br>	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
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

	const GetPostsUser	 = async ($id) =>{
		const response = await fetch('https://jsonplaceholder.typicode.com/users/'+$id+'/posts');
		const posts = await response.json();
		
		let tablePosts = ``;
		posts.forEach((apost, index) =>{
			tablePosts += `
				<div class="col-md-3 mb-5">				
					<div class="card" style="">
					  <div class="card-body">
					    <h5 class="card-title"> ${apost.title}</h5>				    
					    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
					    
					    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onClick="GetDataComments(${apost.id})"> Ver </button>			    
					  </div>
					</div>
				</div>`;
		});

		listado_posts.innerHTML = tablePosts;
	}

	const GetDataComments = async ($id) =>{
		const response = await fetch('https://jsonplaceholder.typicode.com/post/'+$id+'/comments');
		const comments = await response.json();
  		
  		let tablePostComments = ``;
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

		contenido_modal.innerHTML = tablePostComments;
	}
GetPostsUser(idUsuario);
</script>