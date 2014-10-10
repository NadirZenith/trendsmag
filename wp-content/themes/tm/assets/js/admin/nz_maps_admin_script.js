// Shorthand for $( document ).ready()
jQuery(function($) {
      /*console.log(window.google);//undefined*/
});


jQuery(document).ready(function() {
      // executes when HTML-Document is loaded and DOM is ready
      /*alert("document is ready");//1º*/
      /*console.log(window.google);//undefined*/
});


jQuery(window).load(function() {
      // executes when complete page is fully loaded, including all frames, objects and images
      alert("window is loaded");//2º
      /*console.log(window.google);//undefined*/
});