<!DOCTYPE HTML>
<html>
  <head><title>Otsikko</title></head>
  <?php 
    /* HTML-rungon keskellä on sivun sisältö, 
     * joka haetaan sopivasta näkymätiedostosta.
     * Oikean näkymän tiedostonimi on tallennettu muuttujaan $sivu.
     */
    require 'views/'.$sivu; 
  ?>
</html>