<?
require_once("conf/config.php");
includeHeader("test");
?>
      <div class="row-fluid">
        <div class="span12">
          <div class="hero-unit">
            <h1>Tournament Builder</h1>
            <p>Tournament Builder lets you build Coowesomazing tournaments easily</p>
            <p><a href="create.php" class="btn btn-primary btn-large">Create a Tournament &raquo;</a></p>
          </div>
          <div class="row-fluid">
          
      <?php 
      $list_of_tournaments = $db->select("Tournament","*","","","","9");
      echo $test;
      echo "test";
      for ($x=1; $x<=9; $x++)
      {
        if (($x%3)==0) {
          echo "<div class=\"row-fluid\">\n";
        }
        echo "<div class=\"span4\">\n";
        echo "<h2>Tournament: $x </h2>\n";
        echo "<p>Tournament Description: $x </p>\n";
        echo "<p><a class=\"btn\" href=\"#\">View details &raquo;</a></p>\n";
        echo "</div>";
        if (($x%3)==0) {
          echo "</div> <!--/row-->\n";
        }
      } 
      ?>
    </div>
<?require_once("inc/footer.php")?>
