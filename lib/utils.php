<?php
// useful function for sql queries
function fixDb($val) {
    return '"'.addslashes($val).'"';
}