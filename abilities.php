<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>PokeAPI</title>

<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
<div id="wrapper"> 
  <?php include "sidebar.php"; ?>
  <div id="content-wrapper" class="d-flex flex-column"> 
    <div id="content"> 
      <?php include "header.php";?>
      <div class="container-fluid"> 
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Favorites Pokemons</h1>
        </div>
        <div class="row">
          <?php
          $dados = file_get_contents( 'https://pokeapi.co/api/v2/pokemon-habitat' );
          $type = json_decode( $dados );
          foreach ( $type->results as $results ) {
            ?>
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="#" onClick="fabilitypokemon('<?=$results->name?>')">
                      <?=$results->name?>
                      </a></div>
                  </div>
                  <div class="col-auto"> <i class="fas fa-5x"></i> </div>
                </div>
              </div>
            </div>
          </div>
          <?php }?>
        </div>
      </div>  
    </div>
    <footer class="sticky-footer bg-white">
      <div class="container my-auto">
        <div class="copyright text-center my-auto"> <span>Copyright &copy; Your Website 2021</span> </div>
      </div>
    </footer>
  </div>
</div>
<a class="scroll-to-top rounded" href="#page-top"> <i class="fas fa-angle-up"></i> </a> 
<div class="modal fade" id="abilitypokemon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Favorites</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
      </div>
      <div class="modal-body" id="tbodyabilitypokemon">
        <input type="text" id="typepokemonid">
        </input>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="login.html">Logout</a> </div>
    </div>
  </div>
</div>
<script src="vendor/jquery/jquery.min.js"></script> 
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 
<script src="vendor/jquery-easing/jquery.easing.min.js"></script> 
<script src="js/sb-admin-2.min.js"></script> 
<script src="vendor/chart.js/Chart.min.js"></script> 
<script src="js/demo/chart-area-demo.js"></script> 
<script src="js/demo/chart-pie-demo.js"></script> 
<script src="vendor/chart.js/Chart.min.js"></script> 
<script src="vendor/datatables/jquery.dataTables.min.js"></script> 
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>
<script>
function fabilitypokemon(ability)
	{
		var ability = ability;
		
	$.ajax({
                method: 'POST',
                timeout: 5000,
                url: 'data/abilitypokemon.php',
                data: {
                    spokemon: 's',
					ability: ability,
					
					
                },
                dataType: 'json',

                success: function (data) {								
				$ ('#tbodyabilitypokemon').html(data.resposta);
				$('#abilitypokemon').modal('show');				
				}
            });
        
    };
function scardpokemon(pokemon)
	{		

	$.ajax({
                method: 'POST',
                timeout: 5000,
                url: 'spokemon.php',
                data: {
                    spokemon: 's',
					pokemon: pokemon,
					
					
                },
                dataType: 'json',

                success: function (data) {
				document.getElementById('exampleModalLabel').value = data.pokemon;
				
				$ ('#tbodycard').html(data.resposta);
				$('#abilitypokemon').modal('hide');
				$('#searchmodal').modal('show');
				
				
				}
            });
        
    };	
	
</script>
