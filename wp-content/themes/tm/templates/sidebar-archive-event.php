
<div class="aside-item text-center">

      <div id="calendar" ></div>
</div>
<?php
$date = get_query_var( 'date' );
/* $date = $_GET[ 'date' ]; */
$DateTime = DateTime::createFromFormat( 'd-m-Y', $date );
if ( $DateTime ) {
      $DateTime->setTime( 0, 0, 0 ); //to avoid date problems
      $start_date = $DateTime->getTimestamp();
} else {
      $start_date = strtotime( "now" );
}
?>
<script>

      jQuery(document).ready(function($) {



            function updateQueryStringParameter(uri, key, value) {
                  var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
                  var separator = uri.indexOf('?') !== -1 ? "&" : "?";
                  if (uri.match(re)) {
                        return uri.replace(re, '$1' + key + "=" + value + '$2');
                  }
                  else {
                        return uri + separator + key + "=" + value;
                  }
            }

            var start_date = new Date('<?php echo date( 'r', $start_date ) ?>');
            $('#calendar').fullCalendar({
                  header: {
                        left: '',
                        center: 'title',
                        right: 'prev,next'
                  },
                  firstDay: 1,
                  dayClick: function(date, allDay, jsEvent, view) {
                        var date_str = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                        var location = updateQueryStringParameter('<?php echo add_query_arg( NULL, NULL ); ?>', 'date', encodeURIComponent(date_str));
                        window.location = location;
                  },
                  dayRender: function(date, cell) {
                        if (date.getDate() === start_date.getDate()
                                && date.getMonth() === start_date.getMonth()) {
                              cell.css("background-color", "rgba(12,160,230,0.8)");
                        }
                  },
                  monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                  monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                  dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                  dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
            });
            $('#calendar').fullCalendar('gotoDate', start_date);
            $('.fc-button-prev span').click(function() {
                  var date = $('#calendar').fullCalendar('prev').fullCalendar('getDate');
                  var date_str = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                  var location = updateQueryStringParameter('<?php echo add_query_arg( NULL, NULL ); ?>', 'date', encodeURIComponent(date_str));
                  window.location = location;
                  /*alert('prev ' + date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear());*/
                  return false;
            });
            $('.fc-button-next span').click(function() {
                  var date = $('#calendar').fullCalendar('next').fullCalendar('getDate');
                  var date_str = date.getDate() + '-' + (date.getMonth() + 1) + '-' + date.getFullYear();
                  var location = updateQueryStringParameter('<?php echo add_query_arg( NULL, NULL ); ?>', 'date', encodeURIComponent(date_str));
                  window.location = location;
                  /*                  alert('next ' + date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear());*/
                  return false;
            });


      });
</script>
<script>
      jQuery(function($) {
            $("aside.sidebar").stick_in_parent({
                  offset_top: 70
            });
            // call my method

      });
</script>


<div class="aside-item text-center">
      <a href="<?php echo get_permalink( get_page_by_path( 'subir-evento' ) ); ?>">
            Subir Evento
      </a>
</div>
<?php dynamic_sidebar( 'sidebar-event' ); ?>