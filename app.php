<?php 

require_once("db.php");

// GET activities
$activities_query = $conn->query('SELECT `id`,`date`, `type`, `ticketNum`, `subtask`, `description`, `location`, `comment` FROM activities WHERE `userId` = "1" ORDER BY `date` DESC');
$activities = $activities_query->fetchAll(PDO::FETCH_ASSOC);


function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Daily Log - App</title>

        <!-- CDNs -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/23ddf872b5.js" crossorigin="anonymous"></script>

        <!-- custom CSS -->
        <link rel="stylesheet" href="lib/style.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Daily Log</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link isDisabled" href="#">Se déconnecter</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                </form>
            </div>
        </nav>

        <a href="./add.php" class="button-float btn-dark">
            <i class="fa fa-plus button-float-inner"></i>
        </a>

        <div class="container-fluid">
            <div class="row content">
                <div class="col-12 col-md-12 col-lg-12" style="padding: 0 !important;">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th class="date">Date</th>
                                <th class="type">Type</th>
                                <th class="ticketNum">Ticket #</th>
                                <th class="subtask">Subtask</th>
                                <th>Description</th>
                                <th class="location">Location</th>
                                <th>Comment</th>
                                <th class="actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            
                            foreach ($activities as $activity) {

                                $date = date_create($activity["date"]);
                                switch ($activity["type"]) {
                                    case '1':
                                        $type = "Ticket";
                                        break;
                                    
                                    case '2':
                                        $type = "Formation";
                                        break;
                                }

                                switch ($activity["subtask"]) {
                                    case '1':
                                        $subtask = "Dev Analysis";
                                        break;
                                    
                                    case '2':
                                        $subtask = "Development";
                                        break;

                                    case '3':
                                        $subtask = "Unit Testing";
                                        break;

                                    case '4':
                                        $subtask = "Dev Review";
                                        break;
                                    
                                    case '5':
                                        $subtask = "Pre-integration Merge";
                                        break;
                                    
                                    case '6':
                                        $subtask = "Integration Merge";
                                        break;
                                }

                                echo "<tr>";
                                echo "<td>".date_format($date, "Y/m/d")."</td>";
                                echo "<td>".$type."</td>";
                                echo "<td><a href='https://jira.sage.com/browse/X3-".$activity["ticketNum"]."' target='_blank'>".$activity["ticketNum"]."</a></td>";
                                echo "<td>".$subtask."</td>";
                                echo "<td>".$activity["description"]."</td>";
                                echo "<td>".$activity["location"]."</td>";
                                echo "<td>".$activity["comment"]."</td>";
                                echo "<td>"."<a href=delete.php?id=".$activity["id"]."><i class='fas fa-trash'></i></a> <a href='modify.php?id=".$activity["id"]."'><i class='fas fa-edit'></i></a>"."</td>";
                                echo "</tr>";
                            }
                            
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- CDNs -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/esm/popper.min.js" integrity="sha256-3Iu0zFU6cPS92RSC3Pe4DBwjIV/9XKyzYTqKZzly6A8=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- custom scripts -->
    </body>
</html>