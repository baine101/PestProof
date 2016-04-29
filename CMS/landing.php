<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/04/16
 * Time: 00:14
 */


require "nav.php";
require "PDF/PDF.php";
?>
<div class="container">


</div>


<div class="container">
    <div class='box2'>
<?php PDF::PDFList(); ?>
</div>
</div>

<br>
<br>
<br>


<?php

require "footer.php";
?>
