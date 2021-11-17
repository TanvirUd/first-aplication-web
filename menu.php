<nav>
    <a href="index.php">Main</a>
    <a href="recap.php">Cart <?php 
       if(getQtt() > 0){
           echo "<div id='cartNb'>".getQtt()."</div>";
           } ?>
    </a>
</nav>
