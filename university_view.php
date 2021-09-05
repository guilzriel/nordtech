<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
</head>
<body>



<div class="container">

    <h1 class="p-4 w=100 text-center"><i class="fas fa-university"></i> List of Universities</h1>

<table class="table table-bordered  table-striped new_pro col-4">
    <thead class="">
    <tr class="table-info">
        <th>University Name</th>
        <th>Unique Domains</th>
    </tr>
    </thead>
    <tbody>
<?php


foreach ($list_of_universities as $row) {

    $css = $row->url_count > 1 ? 'bg-warning' : '';

    echo '<tr class="'.$css.'" >';
    echo '<td>'. $row->name.'</td>';
    echo '<td class="text-center">'. $row->url_count.'</td>';
    echo '</tr>';


}
?>
    </tbody>
</table>
</div>

</body>
</html>

