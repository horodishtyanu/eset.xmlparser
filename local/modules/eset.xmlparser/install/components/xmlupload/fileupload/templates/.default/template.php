<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 06.06.2019
 * Time: 5:04
 */
?>
<div class="row">
    <div class="container">
        <div class="form-group">
            <label for=""></label>
            <input type="file" class="form-control-file" name="xmlfile" id="xmlfile" placeholder="" aria-describedby="fileHelpId">
        </div>
        <button type="button" id="upload" class="btn btn-primary">Загрузить</button>
    </div>
</div>


<script>
    BX.message({
        AJAX_TEMPLATE_PATH: '<? echo $this->__component->__path; ?>'+'/ajax.php'
    });
</script>

