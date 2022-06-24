<?php

date_default_timezone_set( "Brazil/East" );
$ability = $_POST[ 'ability' ];
$dados = file_get_contents( 'https://pokeapi.co/api/v2/pokemon-habitat/' . $ability . '/' );
$pokemon = json_decode( $dados );


$resposta = '<div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Special Type: ' . $ability . '</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
               
                </thead>
              <tbody><tr align="center">';
$x = 0;
$i = 0;
foreach ( $pokemon->pokemon_species as $results ) {
  $i++;
  if ( $x / 4 != 1 ) {
    $x++;
    $dadospokemon = file_get_contents( 'https://pokeapi.co/api/v2/pokemon/' . $results->name . '' );
    $pokemonname = json_decode( $dadospokemon );
    $name = $pokemonname->name;
    $sprites = $pokemonname->sprites->front_default;
    $resposta .= "<td  align='center'><i class='fas fa-5x'><a onClick='scardpokemon(\"$name\")'><img src='$sprites' data-toggle='tooltip' title='$name'></img></a></i></td>";
  } else {
    $x = 0;
    $resposta .= '</tr><tr>';
  }

  if ( $i == 20 ) {
    break;
  }

}
$resposta .= '              
                </tbody>
              </table>
            </div>
          </div>
        </div>';

$retorno[ 'resposta' ] = $resposta;
echo json_encode( $retorno );

?>