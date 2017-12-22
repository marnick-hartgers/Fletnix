<?php

function makeInput($name = "", $label = "Label", $type = "text", $value="")
{
    $elementId = GUID();

    return "
        <div class='text_input'>
            
            <input type='$type' name='$name' value='$value' id='$elementId' required='' />
            <label for='$elementId'>$label</label>
        </div>
    ";
}