<?php for ($i = 0; $i < 3; $i++) {?>
        <div class="row">
            <?php for ($j = 0; $j < 3; $j++) { 
                $forT = "c{$j}r{$i}"
                ?>
                <div class="row__block">
                    <input type="radio" name="field">
                    <label for="<?= $forT ?>" class="btn btn-label"></label>
                </div>
            <?php } ?>
        </div>
 <?php }?>