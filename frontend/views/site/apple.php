<div class="tree">
    <table border="1" width="100%">
        <?php for($i=1;$i<=5;$i++):?>
            <tr>
            <?php for($j=1;$j<=10;$j++):?>
               <td id="<?=$i.$j?>"></td>
            <?php endfor;?>
            </tr>
        <?php endfor;?>

    </table>
    <div class="apple" onclick="newapple();">

    </div>
    <div><input type="color" name="apple_color"></div>

</div>