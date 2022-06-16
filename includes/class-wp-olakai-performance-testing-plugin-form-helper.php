<?php

function _olakai_func_add_label($id, $label) {
    return "<label for=\"$id\">$label</label><br />";
}

function _olakai_func_add_field($type, $id, $name, $value, $placeholder, $label) {
    $value = $value ? $value : "";
    
    $str = null;
    if($type == "text") {
        $str = "<input type=\"$type\" id=\"$id\" name=\"$name\" value=\"$value\" placeholder=\"$placeholder\" />";
    }

    if($label) {
        $str = _olakai_func_add_label($id, $label) . $str;
    }

    return $str;
}
