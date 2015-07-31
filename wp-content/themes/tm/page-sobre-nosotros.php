<div class="row">
    <div class="col-xs-12 col-md-10">
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('templates/page', 'header'); ?>
            <?php get_template_part('templates/content', 'page'); ?>
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
    'sabrina' => array(
        'img' => 'staff/sabrina.jpg',
        'cargo' => 'Gestión administrativa y de eventos',
        'info' => '
                  <b> SAB pestañas atentas, flequillo certero y pies elevados. </b> <br>
                  Curiosidad, agilidad informativa, expresión verbal y gestión continua.
                  Luego de colaborar con otras revistas online, coordinar la carrera de diseño de moda en Buenos Aires, trabajar como estilista y realizadora de eventos de moda, ingresa a TrendsMag para hablarnos de moda y música, sus dos pasiones.
                  Sab es diseñadora de Moda especializada en comunicación y marketing, además master en Fashion & Visual Merchandising.
                  Sueña con que algún día tendrá una cámara adherida al marco de sus gafas.'
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
    ),
    'Eduard Sánchez Ribot' => array(
        'img' => 'staff/eduard.jpg',
        'cargo' => 'Fotografo y diseñador grafico',
        'info' => ' 
            El momento es la esencia del tiempo, el tiempo es vida y la vida es mi pasión que retratar. 
            Mi fotografía refleja cada detalle de mi vida. Momentos únicos llenos de sentimientos con un 
            punto de vista personal. Observa, piensa y transmite lo que ves. Analógico / Digital.
            Graduado en Ingeniería Multimédia por la Universidad Politécnica de Catalunya. '
    )
);
?>

<h1>STAFF</h1>
<ul id="staff">
    <?php
    foreach ($staff as $user => $data) {
        $User = get_user_by('slug', $user);
        ?>
        <li class="row">
            <article>
                <div class="col-md-2">
                    <img src="<?php echo nz_get_image_asset($staff[$user]['img']) ?>" class="img-circle"/>
                </div>
                <div class="col-md-10">
                    <h2>
                        <?php
                        if ($User){
                            ?>
                                <a href="<?php echo get_author_posts_url($User->ID) ?>">
                                    <?php echo $User->display_name ?>
                                </a>
                                <?php
                        }else{
                            echo $user;
                        }
                        ?>
                    </h2>
                    <span class="text-italic"> 
                        <?php echo $staff[$user]['cargo']; ?> 
                    </span>
                    <p>
                        <?php echo $staff[$user]['info']; ?>
                    </p>
                </div>
            </article>
        </li>
        <?php
    }
    ?>
</ul>
<?php
$contributors = array(
    'Denisse-Garcia' => array(
        'img' => 'staff/denisse.jpg',
        'cargo' => 'Fotógrafa freelance',
        'info' => '
                  Su trabajo se define por su capacidad de explicar lo absurdo, 
                  experimentando con tópicos pero siempre dotando a sus imágenes de un 
                  toque aséptico y personal. Máster de Fotografía y Diseño en ELISAVA y 
                  Graduada en Bellas Artes por la Universidad de Barcelona.'
    ),
    'nuria-cienfuegos' => array(
        'img' => 'staff/nuria.jpg',
        'cargo' => 'Fotógrafa y creativa freelance',
        'info' => '
                  Le gusta entender la fotografía como un mundo multidisciplinar, siempre 
                  construyendo imágenes entre la realidad y la ficción. Máster en Fotografía 
                  y Diseño en ELISAVA y Licenciada en Publicidad y Relaciones Públicas por 
                  la Universidad Autónoma de Barcelona. '
    )
);
?>

<h2>Colaboradores</h2>
<ul id="staff">
    <?php
    foreach ($contributors as $user => $data) {
        $User = get_user_by('slug', $user);
        ?>
        <li class="row">
            <article>
                <div class="col-md-2">
                    <img src="<?php echo nz_get_image_asset($contributors[$user]['img']) ?>" class="img-circle"/>
                </div>
                <div class="col-md-10">
                    <h2>
                        <a href="<?php echo get_author_posts_url($User->ID) ?>">
                            <?php echo $User->display_name ?>
                        </a>
                    </h2>
                    <span class="text-italic"> 
                        <?php echo $contributors[$user]['cargo']; ?> 
                    </span>
                    <p>
                        <?php echo $contributors[$user]['info']; ?>
                    </p>
                </div>
            </article>
        </li>
        <?php
    }
    ?>
</ul>