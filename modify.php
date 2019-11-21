<?php

require_once('db.php');

$id = $_GET['id'];

// GET activity detail
$activity_query = $conn->query('SELECT `id`,`date`, `type`, `ticketNum`, `subtask`, `description`, `location`, `comment` FROM activities WHERE `userId` = "1" AND `id` ='. $id);
$activity = $activity_query->fetchAll(PDO::FETCH_ASSOC);

$date = date_create($activity[0]['date']);
$date_format = date_format($date, "Y-m-d");

if (!empty($_POST)) {
    $date = $_POST['date'];
    $type = $_POST['type'];
    $ticketNum = $_POST['ticketNum'];
    $subtask = $_POST['subtask'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $comment = $_POST['comment'];

    // var_dump($date, $ticketNum, $description, $location);
    
    $sql = "UPDATE `activities` 
            SET `date` = ?, 
            `type` = ?, 
            `ticketNum` = ?, 
            `subtask` = ?, 
            `description` = ?, 
            `location` = ?, 
            `comment` = ? 
            WHERE `userId` = 1 AND `id` =". $id;
    $stmt= $conn->prepare($sql);

    $stmt->execute([$date, $type, $ticketNum, $subtask, $description, $location, $comment]);
    try {
        $conn->beginTransaction();
        $stmt->execute([$date, $type, $ticketNum, $subtask, $description, $location, $comment]);
        $conn->commit();
        header('Location: index.php');
    } catch (Exception $e) {
        $conn->rollback();
        throw e;
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Daily Log - App - Modifier</title>

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
                        <a class="nav-link" href="index.php">Retour</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row content">
                <div class="col-12 col-md-12 col-lg-12">
                    <h1 class="title">Modifier une tache</h1>

                    <form action="./modify.php?id=<?php echo $id ?>" method="post">
                        <div class="form-group">
                            <label>Date : </label>
                            <input type="date" name="date" id="date" value="<?php echo $date_format ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select name="type" id="type" onchange="setRequired()" required>
                            <?php
                                switch ($activity[0]['type']) {
                                    case '1':
                                        echo('
                                        <option value="1" selected>Ticket</option>
                                        <option value="2">Formation</option>');
                                        break;
                                    
                                    case '2':
                                        echo('
                                        <option value="1">Ticket</option>
                                        <option value="2" selected>Formation</option>');
                                        break;
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Numero du ticket</label>
                            <input type="number" name="ticketNum" id="ticketNum" value="<?php echo $activity[0]['ticketNum'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Sous-tache</label>
                            <select name="subtask" id="subtask">
                                <?php
                                    switch ($activity[0]['subtask']) {
                                        case '1':
                                            echo('
                                            <option disabled></option>
                                            <option value="1" selected>Dev Analysis</option>
                                            <option value="2">Development</option>
                                            <option value="3">Unit Testing</option>
                                            <option value="4">Dev Review</option>
                                            <option value="5">Pre-integration Merge</option>
                                            <option value="6">Merge</option>');
                                            break;
                                        
                                        case '2':
                                            echo('
                                            <option disabled></option>
                                            <option value="1">Dev Analysis</option>
                                            <option value="2" selected>Development</option>
                                            <option value="3">Unit Testing</option>
                                            <option value="4">Dev Review</option>
                                            <option value="5">Pre-integration Merge</option>
                                            <option value="6">Merge</option>');
                                            break;

                                        case '3':
                                            echo('
                                            <option disabled></option>
                                            <option value="1">Dev Analysis</option>
                                            <option value="2">Development</option>
                                            <option value="3" selected>Unit Testing</option>
                                            <option value="4">Dev Review</option>
                                            <option value="5">Pre-integration Merge</option>
                                            <option value="6">Merge</option>');
                                            break;
                                            
                                        case '4':
                                            echo('
                                            <option disabled></option>
                                            <option value="1">Dev Analysis</option>
                                            <option value="2">Development</option>
                                            <option value="3">Unit Testing</option>
                                            <option value="4" selected>Dev Review</option>
                                            <option value="5">Pre-integration Merge</option>
                                            <option value="6">Merge</option>');
                                            break;
                                        
                                        case '5':
                                            echo('
                                            <option disabled></option>
                                            <option value="1">Dev Analysis</option>
                                            <option value="2">Development</option>
                                            <option value="3">Unit Testing</option>
                                            <option value="4">Dev Review</option>
                                            <option value="5" selected>Pre-integration Merge</option>
                                            <option value="6">Merge</option>');
                                            break;
                                                
                                        case '6':
                                            echo('
                                            <option disabled></option>
                                            <option value="1">Dev Analysis</option>
                                            <option value="2">Development</option>
                                            <option value="3">Unit Testing</option>
                                            <option value="4">Dev Review</option>
                                            <option value="5">Pre-integration Merge</option>
                                            <option value="6" selected>Merge</option>');
                                            break;
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="description" cols="50" rows="1" style="resize: none;" required><?php echo $activity[0]['description'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="location" id="location" value="<?php echo $activity[0]['location'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea name="comment" id="comment" cols="50" rows="1" ><?php echo $activity[0]['comment'] ?></textarea>
                        </div>

                        <br><input type="submit" value="Modifier">
                    </form>

                </div>
            </div>
        </div>
        
        <!-- CDNs -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/esm/popper.min.js" integrity="sha256-3Iu0zFU6cPS92RSC3Pe4DBwjIV/9XKyzYTqKZzly6A8=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!-- custom scripts -->
        
        <script>
            document.addEventListener("DOMContentLoaded",function(){

                let today = new Date(Date.now());
                let todayformat = today.toISOString().substring(0, 10);                
                document.getElementById('date').setAttribute('min', todayformat);

                setRequired();
            });

            function setRequired() {
                let type = document.getElementById('type');
                let ticketNum = document.getElementById('ticketNum');
                let subtask = document.getElementById('subtask');

                if (type.value == 1) {
                    ticketNum.setAttribute('required', '');
                    subtask.setAttribute('required', '');
                } else {
                    ticketNum.removeAttribute('required');
                    subtask.removeAttribute('required');
                }
            }
        </script>
    </body>
</html>