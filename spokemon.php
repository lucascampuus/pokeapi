<?php
date_default_timezone_set( "Brazil/East" );
$type = '';
$abyllitiespokemon = '';
$imgsevolution = '';
$nameevolutionspecie = '';
$nhaveolution = null;
$spokemon = strtolower( $_POST[ 'pokemon' ] );
if ( $dadospokemon = @file_get_contents( 'https://pokeapi.co/api/v2/pokemon/' . $spokemon . '/' ) ) {
  $pokemon = json_decode( $dadospokemon );
  $pokemonteste = json_decode( $dadospokemon, true );
  foreach ( $pokemonteste[ 'abilities' ] as $results ) {
    $abyllitiespokemon .= $results[ 'ability' ][ 'name' ] . '  ';
  }


  if ( !is_numeric( $spokemon ) ) {
    $spokemon = $pokemon->id;
    $pokemoname = $pokemon->name;
  } else {
    $pokemoname = $pokemon->name;
  }

  foreach ( $pokemon->types as $results ) {
    $type .= $results->type->name . '  ';
  }
  $evolution = @file_get_contents( 'https://pokeapi.co/api/v2/pokemon-species/' . $spokemon . '/' );
  $evolutionchain = json_decode( $evolution );

  $snhaveolution = $evolutionchain->evolves_from_species;
  if ( $snhaveolution != null ) {
    $nhaveolution = 'Evolution from: ' . $evolutionchain->evolves_from_species->name;
    $nameevolutionspecie = $evolutionchain->evolves_from_species->name;
    $dadospokemone = @file_get_contents( 'https://pokeapi.co/api/v2/pokemon/' . $nameevolutionspecie . '/' );
    $pokemone = json_decode( $dadospokemone );
    $pokemoneimg = $pokemone->sprites->front_default;
    $imgsevolution .= "<img src=\"$pokemoneimg\" align='center' width='200' onclick='scardpokemon2(\"$nameevolutionspecie\")' data-toggle='tooltip' title='Click to See'></img>";

  }
  $habitatpokemon = $evolutionchain->habitat;
  if ( $habitatpokemon != null ) {
    $habitatpokemon = $evolutionchain->habitat->name;
  } else {
    $habitatpokemon = 'unknown';
  }

  $evolutionchain = $evolutionchain->evolution_chain->url;
  $evolution = @file_get_contents( $evolutionchain );
  $evolutionchain = json_decode( $evolution );
  $evolutionname = "";
  $evolutionname1 = "";
  $evolutionname2 = "";
  $evolutionname0 = $evolutionchain->chain->species->name;
  $dadospokemone0 = file_get_contents( 'https://pokeapi.co/api/v2/pokemon/' . $spokemon . '/' );
  $pokemon0 = json_decode( $dadospokemone0 );
  $imgs = '<img src="' . $pokemon0->sprites->front_default . '" align="center" width="150" data-toggle="tooltip" title="' . $pokemoname . '"></img><img src="' . $pokemon0->sprites->back_default . '" align="center" width="150" data-toggle="tooltip" title="' . $pokemoname . '"></img>';

  foreach ( $evolutionchain->chain->evolves_to as $resultschain ) {
    if ( !empty( $resultschain ) ) {
      $evolutionname1 = $resultschain->species->name;
      $dadospokemone1 = file_get_contents( 'https://pokeapi.co/api/v2/pokemon/' . $evolutionname1 . '/' );
      $pokemon1 = json_decode( $dadospokemone1 );
      if ( $pokemoname != $evolutionname1 ) {
        $evolutionname = 'Next Evolution: ' . $evolutionname1;
        if ( $evolutionname1 != $nameevolutionspecie ) {
          $pokemon1img = $pokemon1->sprites->front_default;
          $imgsevolution .= "<img src=\"$pokemon1img\" align='center' width='150' onclick='scardpokemon2(\"$evolutionname1\")' data-toggle='tooltip' title='Click to See'></img>";
        }
      }


      foreach ( $resultschain->evolves_to as $resultschainevolves ) {
        if ( !empty( $resultschainevolves ) ) {
          $evolutionname2 = $resultschainevolves->species->name;

          $dadospokemone2 = file_get_contents( 'https://pokeapi.co/api/v2/pokemon/' . $evolutionname2 . '/' );
          $pokemon2 = json_decode( $dadospokemone2 );
          $pokemon2img = $pokemon2->sprites->front_default;

          if ( $pokemoname != $evolutionname2 ) {
            $imgsevolution .= "<img src=\"$pokemon2img\" align='center' width='150' onclick='scardpokemon2(\"$evolutionname2\")' data-toggle='tooltip' title='Click to See'></img>";
            $evolutionname .= '<BR>Max Evolution: ' . $evolutionname2;
          } else {
            $evolutionname = "<BR>Pokemon in MAX Evolution";
          }
        }
      }
    }
  }

  $resposta = '
               <div class="row">
			   <div class="col-lg-6 mb-6">
               <div class="card shadow mb-4">
               <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Pokemon: ' . $pokemoname . '</h6></div>
			   <div class="card-body" align="center">
		       ' . $imgs . '</div>
		      </div>
			  </div>
			 <div class="col-lg-6 mb-6">
			   
               <div class="card shadow mb-4">
               <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Types ans Abillitys</h6></div>
			   
			   <div class="card-body" align="left">
			   <strong>Type:</strong> ' . $type . ' <BR>   
			   <strong>Habitat:</strong> ' . $habitatpokemon . ' <BR>
			   <strong>Abillitys:</strong> ' . $abyllitiespokemon . ' <BR>
			   
			   
			   </div>
			   </div>
		       
			   
			   ';
  if ( !empty( $snhaveolution ) || ( !empty( $resultschainevolves ) || !empty( $resultschain ) ) ) {
    $resposta .= '</div><div class="col-lg-12 mb-6">
			   
               <div class="card shadow mb-4">
               <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Evolutions</h6></div>
			   <div class="card-body" align="center">
			   ' . $nhaveolution . '
			   ' . $evolutionname . '<BR>
		       ' . $imgsevolution . '</div>
		       </div>';
  }


  $resposta .= '</div><div class="col-lg-12 mb-6">
			  	<div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Stats</h6>
                                </div>
                                <div class="card-body">';


  //$nstats=$pokemonteste['stats'][0]['stat']['name'];
  $cc = 0;
  foreach ( $pokemonteste[ 'stats' ] as $results ) {
    $nstats = $results[ 'stat' ][ 'name' ];
    $bstats = $results[ 'base_stat' ];
    //print_r(nstats);
    //$resposta.=''.$nstats.'='.$bstats.'';
    $color = array( 'success', 'primary', 'warning', 'danger', 'info', 'light' );


    $resposta .= '<h4 class="small font-weight-bold">' . strtoupper( $nstats ) . '<span
                                            class="float-right">' . $bstats . '</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-' . $color[ $cc ] . '" role="progressbar" style="width:' . $bstats . '%"
                                            aria-valuenow="11" aria-valuemin="0" aria-valuemax="200"></div>
                                </div>';
    $cc++;
  }
  $resposta .= '                      </div>
                            </div>
                        </div>';

  $retorno[ 'resposta' ] = $resposta;
  $retorno[ 'pokemon' ] = $spokemon;
} else {
  $retorno[ 'resposta' ] = 'Pokemon Não encontrado!';
}

echo json_encode( $retorno );

?>