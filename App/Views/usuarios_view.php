<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Usuarios</title>
    </head>
    <body>

    <table>

    <tr><td>Nombre del Usuario</td>
        <?php
            foreach ($datos as $item) {
                echo "<tr><td>". $item["nombre"]."</td></tr>";
            }
        ?>

    </table>
    </body>
</html>