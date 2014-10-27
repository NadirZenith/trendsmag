<div class="row">

      <div class="col-xs-12 col-md-8">
            <?php while ( have_posts() ) : the_post(); ?>
                  <?php get_template_part( 'templates/page', 'header' ); ?>
                  <?php get_template_part( 'templates/content', 'page' ); ?>
            <?php endwhile; ?>
      </div>
</div>

<h1>STAFF</h1>

<style>
      #staff {
            list-style: none;
      }
      #staff  li{
            margin-top: 40px;
      }

      #staff  img{
            width: 100%;
            /*margin-left: auto;*/
            /*margin-right: auto;*/
      }

</style>
<ul id="staff">
      <li class="row">
            <article>
                  <div class="col-md-2">
                        <img src="<?php echo nz_get_image_asset( 'staff/fran.jpg' ) ?>" class="img-circle"/>
                  </div>
                  <div class="col-md-10">
                        <h2>Fran</h2>
                        <span class="text-italic"> Directora </span>
                        <p>
                              <b> FRAN, Nunca pasará de moda, porque siempre conoce la moda. </b> <br>
                              Analista de tendencias especializada en culturas juveniles y tribus urbanas, actualmente enfoca su trabajo hacia el análisis de moda. Se formó como Coolhunter en la agencia DMentes, donde descubrió que el mundo de las tendencias es su verdadero camino.

                              Fran es nuestra experta en moda, pero sus inquietudes la convierten, sin duda, en una inagotable fuente de conocimiento acerca de todo lo que puede catalogarse como “urbano”: arte, style, música, deporte…

                              Seguramente la veréis más de una vez investigando por el Raval en su querida bicicleta.
                        </p>
                  </div>
            </article>

      </li>
      <li class="row">
            <article>
                  <div class="col-md-2">
                        <img src="<?php echo nz_get_image_asset( 'staff/macarena.jpg' ) ?>" class="img-circle"/>
                  </div>
                  <div class="col-md-10">
                        <h2> Macarena </h2>
                        <span class="text-italic"> Redactora y relaciones públicas </span>
                        <p>
                              <b> MACARENA, Mujer de muchas palabras, habladas y escritas. </b> <br>
                              Procedente del mundo de las agencias de publicidad, completó su formación con un postgrado en Coolhunting que la llevó a reenfocar su carrera completamente, esta vez hacia el ámbito editorial y de las tendencias.

                              Tras su paso por otras revistas online, Macarena aterriza en TrendsMag con el objetivo de fusionar su pasión por la investigación y el copywriting con su expertise como Project Manager y Relaciones Públicas.

                              La veréis a menudo porque no se pierde ni un evento, pero tranquilos que, aunque lo parezca, no sabe teletransportarse. Aún no.
                        </p>
                  </div>

            </article>

      </li>
      <li class="row">
            <article>

                  <div class="col-md-2">
                        <img src="<?php echo nz_get_image_asset( 'staff/felipe.jpg' ) ?>" class="img-circle"/>
                  </div>
                  <div class="col-md-10">
                        <h2>Felipe</h2>
                        <span class="text-italic"> Redactor y fotógrafo </span>
                        <p>
                              <b> FELIPE, Él sí que sabe escuchar. Y diseñar, y fotografiar, y… </b> <br>
                              Del Marketing pasó al Coolhunting, y ahora se ha lanzado a la búsqueda de más conocimientos en un Máster en Arte, Diseño y Espacios Públicos.

                              Felipe tiene interés por la innovación en general, pero por encima de todo, Felipe tiene buen oído y buena vista, lo que le convierte en nuestro gurú de la música y en el fotógrafo oficial de TrendsMag.

                              Le apasiona la fotografía, la música, la antropología, la moda, el arte, la filosofía… El día que logre poner en común todas esas áreas, será el hombre más feliz del planeta.
                        </p>
                  </div>
            </article>
      </li>
      <li class="row">
            <article>
                  <div class="col-md-2">
                        <img src="<?php echo nz_get_image_asset( 'staff/cristina.jpg' ) ?>" class="img-circle"/>
                  </div>
                  <div class="col-md-10">
                        <h2> Cristina </h2>
                        <span class="text-italic"> Fotógrafa </span>
                        <p>
                              <b> CRISTINA, Cazadora profesional con una puntería excepcional. </b> <br>
                              Diseñadora de interiores especializada en el diseño de espacios comerciales, hace más de tres años que empezó con su blog The StreetStyle Hunter y se podría decir que ha convertido su pasión por la observación en su profesión. Ahora se une al equipo de TrendsMag trayendo consigo toda su experiencia como fotógrafa de streetstyle.

                              Cristina adora la variedad de estilos, pero también la variedad de personalidades, y eso se nota mucho en sus fotografías, en las que captura ambas cosas de manera artística.

                              Siempre lleva su cámara encima, así que ¡cuidado!, cualquier día de estos te cruzas con ella y te dispara un buen par de fotos.
                        </p>
                  </div>

            </article>

      </li>
</ul>