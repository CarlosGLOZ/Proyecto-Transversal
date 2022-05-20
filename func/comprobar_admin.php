<?php

if (!$_SESSION['admin']) {
    echo "<script>window.location.href = '../view/'</script>";
    die();
}