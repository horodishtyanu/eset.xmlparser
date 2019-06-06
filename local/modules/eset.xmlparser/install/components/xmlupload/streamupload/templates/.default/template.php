<?php

?>


<div class="row">
    <div class="container">
        <div class="container">
            <form id="streamform">
                <div class="form-group">
                    <label for="">Скопируйте содержимое файла сюда!</label>
                    <textarea class="form-control" name="streamXml" id="streamXML" rows="5"></textarea>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    BX.message({
        AJAX_STREAM_TEMPLATE_PATH: '<? echo $this->__component->__path; ?>'+'/ajax.php'
    });
</script>
