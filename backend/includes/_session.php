<?php
if ($_SESSION['session'] != "admin") {
    echo "<script>window.location='" . base_url . "'</script>";
} else if ($_SESSION['nivel'] !== "1" && $seccion_actual === "usuarios") {
    echo "<script>window.location='" . base_url . "'</script>";
} else if (in_array("todos", $sec) || in_array($seccion_actual, $sec)) {

} else {
    echo "<script>window.location='" . base_url . "'</script>";
}
