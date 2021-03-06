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
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head> 
<body id="page-top">
<div id="wrapper">   
      <!-- Sidebar -->
      <?php include "sidebar.php"; ?>
      <div id="content-wrapper" class="d-flex flex-column"> 
    <div id="content">      
          <!-- Topbar -->
          <?php include "header.php";?>
          <div class="container-fluid"> 
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">My Favorites</h1>
            </div>
        <div class="row">
              <?php
              for ( $id = 0; $id < 8; $id++ ) {
                $idx = array( '3', '6', '9', '56', '12', '249', '22', '55' );
                $dados = file_get_contents( 'https://pokeapi.co/api/v2/pokemon/' . $idx[ $id ] . '/' );
                $pokemon = json_decode( $dados );
                ?>
              <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><a href="#" onclick=scardpokemon2('<?=$pokemon->name?>')>
                      <?=$pokemon->name?>
                      </a></div>
                  </div>
                      <div class="col-auto"> <i class="fas fa-5x"><img src="<?=$pokemon->sprites->front_default?>"</img> </i> </div>
                    </div>
              </div>
                </div>
          </div>
              <?php } ?>           
            </div>
        
        <div class="row"> 
              <div class="col-lg-12 mb-4"> 
            <div class="card shadow mb-4">
                  <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Stats Pokemons by habitat</h6>
              </div>
                  <div class="card-body">
                <?php
                $dados = file_get_contents( 'https://pokeapi.co/api/v2/pokemon-habitat' );
                $habitats = json_decode( $dados );
                $y = 0;
                foreach ( $habitats->results as $results ) {
                  $x = 0;
                  $dadoshabitat = file_get_contents( 'https://pokeapi.co/api/v2/pokemon-habitat/' . $results->name . '/' );
                  $shabitats = json_decode( $dadoshabitat );
                  foreach ( $shabitats->pokemon_species as $results2 ) {
                    $x++;
                  }
                  $y = $y + $x;
                }
                foreach ( $habitats->results as $results ) {
                  $x = 0;
                  $dadoshabitat = file_get_contents( 'https://pokeapi.co/api/v2/pokemon-habitat/' . $results->name . '/' );
                  $shabitats = json_decode( $dadoshabitat );
                  foreach ( $shabitats->pokemon_species as $results2 ) {
                    $x++;
                  }
                  $x = round( ( $x * 100 ) / $y, 1 );
                  echo '<h4 class="small font-weight-bold">' . $results->name . '<span class="float-right">' . $x . '%</span></h4>
                <div class="progress mb-4">
                      <div class="progress-bar bg-dark" role="progressbar" style="width: ' . $x . '%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>';
                }
                ?>
              </div>
                </div>
          </div>
        </div>
      </div>         
   </div>
   <footer class="sticky-footer bg-white">
          <div class="container my-auto">
        <div class="copyright text-center my-auto"> <span>Copyright &copy; PokeAPI2022</span> </div>
      </div>
   </footer>
  </div>
</div>
<a class="scroll-to-top rounded" href="#page-top"> <i class="fas fa-angle-up"></i> </a> 
<div class="modal fade" id="searchmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document"">
    <div class="modal-content">
          <div class="modal-body">.</div>
          <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript--> 
<script src="vendor/jquery/jquery.min.js"></script> 
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 

<!-- Core plugin JavaScript--> 
<script src="vendor/jquery-easing/jquery.easing.min.js"></script> 

<!-- Custom scripts for all pages--> 
<script src="js/sb-admin-2.min.js"></script> 
<script src="js/src/tooltip.js"></script> 

<!-- Page level plugins --> 
<script src="vendor/chart.js/Chart.min.js"></script> 

<!-- Page level custom scripts --> 
<script src="js/demo/chart-area-demo.js"></script> 
<script src="js/demo/chart-pie-demo.js"></script>
</body>
    </html>
<script>
function scardpokemon2(pokemon)
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
				//$('#typepokemon').modal('hide');
				$('#searchmodal').modal('show');
				
				
				}
            });
        
    };	</script>
