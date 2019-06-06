<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 06.06.2019
 * Time: 5:03
 */
?>

<style>
    .mn-text{
        font-size:16px;
    }
    .toggle, .version-name{
        cursor:pointer;
        font-size: 14px;
        align-items: center;
        border-left: 1px dashed gray;
        margin-left: 30px;
        border-bottom: 1px solid;
    }
    .padding{
        display: none;
        padding-left: 30px;
    }
</style>

<div class="row">
    <div class="container">
        <div class="mn-text">Общее количество загрузок: <b><?=$arResult['ALL_AMOUNT'];?></b></div>
        <div class="rep-wr">
            <?foreach ($arResult['VENDORS'] as $vendor):?>
            <div class="rep-elem">
                <div class="vendor-name toggle d-flex justify-content-between" style="height: 50px;"><?=$vendor['VENDOR_NAME']?><span><b>Загузок: <?=$vendor['VENDOR_COUNT']?></b></span></div>

                <div class="vendor-body padding">
                    <?foreach ($vendor['VENDOR_PROGRAMS'] as $program):?>
                    <div class="product-name toggle d-flex justify-content-between" style="height: 50px;"><?=$program['NAME']?><span><b>Загузок: <?=$program['COUNT']?></b></span></div>
                    <div class="product-body padding">
                        <?foreach ($program['VERSIONS'] as $version):?>
                        <div class="version-name d-flex justify-content-between" style="height: 50px;"><?=$version['NAME']?><span><b>Загузок: <?=$version['COUNT']?></b></span></div>
                        <?endforeach;?>
                    </div>
                    <?endforeach;?>
                </div>
            </div>
            <?endforeach;?>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.toggle', function () {
        $(this).next('div').toggle();
    })
</script>

