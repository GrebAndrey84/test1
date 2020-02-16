<div>
    <div class="funcs">
        <div>
            <input id="appleColor" type="color" name="apple_color" title="Выбрать цвет">
        </div>
        <div id="newApple" class="apple" title="Генерировать яблоко"></div>
    </div>

    <div class="tree">
        <table class="appleOnTree" border="1" align="center">
            <?php for($i=0;$i<7;$i++):?>
            <tr>
                <?php for($j=1;$j<8;$j++):?>
                    <td id="t<?=$i*10+$j?>"></td>
                <?php endfor;?>
            </tr>
            <?php endfor;?>
        </table>
    </div>
</div>