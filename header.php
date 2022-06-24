<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"> 
  
  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"> <i class="fa fa-bars"></i> </button>
  
  <!-- Topbar Search -->
  <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
    <div class="input-group">
      <input type="text" id="searchpokemon" class="form-control bg-light border-0 small" placeholder="Search for a Poke Here (Name or ID)..."
                                aria-label="Search" aria-describedby="basic-addon2">
      <div class="input-group-append">
        <button class="btn btn-primary" type="button" onClick="cardpokemon()"> <i class="fas fa-search fa-sm"></i> </button>
      </div>
    </div>
  </form>
  
  <!-- Topbar Navbar --> 
  
</nav>
<div class="modal fade" id="searchmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
  <div class="modal-dialog modal-lg modal-scrollalbel " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
      </div>
      <div class="modal-body" id="tbodycard"></div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Voltar</button>
      </div>
    </div>
  </div>
</div>
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
				$('#searchmodal').modal('show');
				
				
				}
            });
        
    };	
function cardpokemon()
	{
		var pokemon = document.getElementById('searchpokemon').value;

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
				$('#searchmodal').modal('show');
				
				
				}
            });
        
    };	
</script>