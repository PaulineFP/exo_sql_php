<?php

//pour evité de devoir tjr ecrire htmlentities
function e (string $string) {
    return htmlentities($string);
}