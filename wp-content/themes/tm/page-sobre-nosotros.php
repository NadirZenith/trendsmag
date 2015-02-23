<div class="row">
      <div class="col-xs-12 col-md-10">
            <?php while ( have_posts() ) : the_post(); ?>
                  <?php get_template_part( 'templates/page', 'header' ); ?>
                  <?php get_template_part( 'templates/content', 'page' ); ?>
            <?php endwhile; ?>
      </div>
</div>


<?php
$staff = array(
      'francescaberni' => array(
            'img' => 'staff/fran.jpg',
            'cargo' => 'Directora',
            'info' => '
                  <b> FRAN, Nunca pasará de moda, porque siempre conoce la moda. </b> <br>
                  Analista de tendencias especializada en culturas juveniles y tribus urbanas, actualmente enfoca su trabajo hacia el análisis de moda. Se formó como Coolhunter en la agencia DMentes, donde descubrió que el mundo de las tendencias es su verdadero camino.
                  Fran es nuestra experta en moda, pero sus inquietudes la convierten, sin duda, en una inagotable fuente de conocimiento acerca de todo lo que puede catalogarse como “urbano”: arte, style, música, deporte…
                  Seguramente la veréis más de una vez investigando por el Raval en su querida bicicleta.'
      ),
      'macarena' => array(
            'img' => 'staff/maca.jpg',
            'cargo' => 'Editora y relaciones públicas',
            'info' => '
                  <b> MACARENA, Mujer de muchas palabras, habladas y escritas. </b> <br>
                  Procedente del mundo de las agencias de publicidad, completó su formación con un postgrado en Coolhunting que la llevó a reenfocar su carrera completamente, esta vez hacia el ámbito editorial y de las tendencias.
                  Tras su paso por otras revistas online, Macarena aterriza en TrendsMag con el objetivo de fusionar su pasión por la investigación y el copywriting con su expertise como Project Manager y Relaciones Públicas.
                  La veréis a menudo porque no se pierde ni un evento, pero tranquilos que, aunque lo parezca, no sabe teletransportarse. Aún no.'
      ),
      'Felipe-Marx' => array(
            'img' => 'staff/felipe.jpg',
            'cargo' => 'Redactor y fotógrafo',
            'info' => ' 
                  <b> FELIPE, Él sí que sabe escuchar. Y diseñar, y fotografiar, y… </b> <br>
                  Del Marketing pasó al Coolhunting, y ahora se ha lanzado a la búsqueda de más conocimientos en un Máster en Arte, Diseño y Espacios Públicos.
                  Felipe tiene interés por la innovación en general, pero por encima de todo, Felipe tiene buen oído y buena vista, lo que le convierte en nuestro gurú de la música y en el fotógrafo oficial de TrendsMag.
                  Le apasiona la fotografía, la música, la antropología, la moda, el arte, la filosofía… El día que logre poner en común todas esas áreas, será el hombre más feliz del planeta.'
      ),
      'Cristina' => array(
            'img' => 'staff/cristina.jpg',
            'cargo' => 'Fotógrafa',
            'info' => ' 
                  <b> CRISTINA, Cazadora profesional con una puntería excepcional. </b> <br>
                  Diseñadora de interiores especializada en el diseño de espacios comerciales, hace más de tres años que empezó con su blog The StreetStyle Hunter y se podría decir que ha convertido su pasión por la observación en su profesión. Ahora se une al equipo de TrendsMag trayendo consigo toda su experiencia como fotógrafa de streetstyle.
                  Cristina adora la variedad de estilos, pero también la variedad de personalidades, y eso se nota mucho en sus fotografías, en las que captura ambas cosas de manera artística.
                  Siempre lleva su cámara encima, así que ¡cuidado!, cualquier día de estos te cruzas con ella y te dispara un buen par de fotos.'
      ),
      'InesTroytino' => array(
            'img' => 'staff/ines.jpg',
            'cargo' => 'Redactora',
            'info' => ' 
                  <b> INÉS, Amante de Hipérbole, Tilde y Sintaxis. </b> <br>
                  Adicta al teclado, ha colaborado en numerosas revistas y eventos a lo largo
                  de su carrera. A pesar de su formación en los campos del Marketing y del Community Manager,
                  ella se considera una mujer autodidacta a la que le encanta aprender de todo. Seguramente por eso,
                  Inés es nuestra redactora más multidisciplinar: se nutre de aquí y de allá, conoce de esto y de lo otro
                  y siempre, absolutamente siempre, el resultado son artículos llenos de pasión. Si queréis hacerla feliz,
                  preguntadle por la moda de los 90. Sabe más que Kate Moss.'
      )
);
?>

<h1>STAFF</h1>
<ul id="staff">
      <?php
      foreach ( $staff as $user => $data ) {
            $User = get_user_by( 'slug', $user );
            ?>
            <li class="row">
                  <article>
                        <div class="col-md-2">
                              <img src="<?php echo nz_get_image_asset( $staff[ $user ][ 'img' ] ) ?>" class="img-circle"/>
                        </div>
                        <div class="col-md-10">
                              <h2>
                                    <a href="<?php echo get_author_posts_url( $User->ID ) ?>">
                                          <?php echo $User->display_name ?>
                                    </a>
                              </h2>
                              <span class="text-italic"> 
                                    <?php echo $staff[ $user ][ 'cargo' ]; ?> 
                              </span>
                              <p>
                                    <?php echo $staff[ $user ][ 'info' ]; ?>
                              </p>
                        </div>
                  </article>
            </li>
            <?php
      }
      ?>
</ul>