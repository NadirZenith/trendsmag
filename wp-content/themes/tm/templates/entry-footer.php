<footer >
      <div style="margin-top: 20px;">
            <?php
            nz_get_next_prev_links();
            ?>
      </div>
      <div style="margin-top: 20px;">

           
            
             <?php echo nz_get_time_elapsed(); ?>
            &nbsp;
            <span style="color: black" class="glyphicon glyphicon-tags"></span>
            <?php nz_the_tags( '' ); ?>
      </div>

</footer>