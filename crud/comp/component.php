<?php
function comp($icon, $place_holder, $name, $value){
    $ele = "
    
    <div class=\"input-group mb-2\">
                    <div class=\"input-group-prepend\">
                        <div class=\"input-group-text bg-warning\">$icon</div>
                    </div>
                    <input type=\"text\" name='$name' value='$value'  autocomplete=\"off\" class=\"form-control\" id=\"inlineFormInputGroup\" placeholder='$place_holder'>
                </div>
    ";
    echo $ele;
}
function But($name, $attr, $text, $id, $class){
    $button = "<button name='$name''$attr' id='$id' class='$class'>$text</button>";
    echo $button;
}