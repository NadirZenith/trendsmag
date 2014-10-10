<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
                <div class="item active">
                        <a href="#image1">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/1.jpg" alt="...">
                        </a>
                        <div class="carousel-caption">
                                IMAGE DESCRIPTION
                        </div>
                </div>
                <div class="item">
                        <a href="#image2">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/2.jpg" alt="...">
                                <span class="carousel-caption">
                                        IMAGE DESCRIPTION
                                </span>
                        </a>
                </div>
                <div class="item">
                        <a href="#image3">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/3.jpg" alt="...">
                                <span class="carousel-caption">
                                        IMAGE DESCRIPTION
                                </span>
                        </a>
                </div>
                <div class="item">
                        <a href="#image4">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/4.jpg" alt="...">
                                <span class="carousel-caption">
                                        IMAGE DESCRIPTION
                                </span>
                        </a>
                </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
</div>