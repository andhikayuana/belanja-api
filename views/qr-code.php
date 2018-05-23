<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scan The Product Here</title>
</head>
<body>
    <table>
        <tr>
        <?php foreach ($products as $item) : ?>
           <td>
                <img src="<?php echo $item['qr_code_image'] ?>" alt="<?php echo $item['name'] ?>">
           </td>
        <?php endforeach ?>
        </tr>
    </table>
</body>
</html>