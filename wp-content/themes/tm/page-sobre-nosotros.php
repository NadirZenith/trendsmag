<?php while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'templates/page', 'header' ); ?>
      <?php get_template_part( 'templates/content', 'page' ); ?>
<?php endwhile; ?>



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
                        <span class="text-italic">
                              Directora
                        </span>
                        <p>
                              <b>
                                    FRAN, Nunca pasará de moda, porque siempre conoce la moda.
                              </b>
                              <br>
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
                        <span class="text-italic">
                              Redactora / Relaciones publicas
                        </span>
                        <p>
                              <b>
                                    FRAN, Nunca pasará de moda, porque siempre conoce la moda.
                              </b>
                              <br>
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
                        <img src="<?php echo nz_get_image_asset( 'staff/felipe.jpg' ) ?>" class="img-circle"/>
                  </div>
                  <div class="col-md-10">
                        <h2>Felipe</h2>
                        <span class="text-italic">
                              Fotógrafo / Colaborador
                        </span>
                        <p>
                              <b>
                                    FRAN, Nunca pasará de moda, porque siempre conoce la moda.
                              </b>
                              <br>
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
                        <img src="<?php echo nz_get_image_asset( 'staff/cristina.jpg' ) ?>" class="img-circle"/>

                  </div>
                  <div class="col-md-10">
                        <h2> Cristina </h2>
                        <span class="text-italic">
                              Colaboradora / Fotógrafa
                        </span>
                        <p>
                              <b>
                                    FRAN, Nunca pasará de moda, porque siempre conoce la moda.
                              </b>
                              <br>
                              Analista de tendencias especializada en culturas juveniles y tribus urbanas, actualmente enfoca su trabajo hacia el análisis de moda. Se formó como Coolhunter en la agencia DMentes, donde descubrió que el mundo de las tendencias es su verdadero camino.

                              Fran es nuestra experta en moda, pero sus inquietudes la convierten, sin duda, en una inagotable fuente de conocimiento acerca de todo lo que puede catalogarse como “urbano”: arte, style, música, deporte…

                              Seguramente la veréis más de una vez investigando por el Raval en su querida bicicleta.
                        </p>
                  </div>

            </article>

      </li>
</ul>