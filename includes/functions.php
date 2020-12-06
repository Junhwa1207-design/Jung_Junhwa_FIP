<?php
    //$result will store the database request results so that we can encode and return them to index.php
$result = array();

function getAllUsers($conn)
{
    $query = "SELECT * FROM portfolio";

    $runQuery = $conn->query($query);

    while ($row = $runQuery->fetchAll(PDO::FETCH_ASSOC)) {
        $result[] = $row;
    }

    //return $result;
    echo(json_encode($result));
}

//get a specific user
function getSingleUser($conn, $id)
{
    $query = "SELECT * FROM portfolio WHERE id=" . $id . "";

    

    $runQuery = $conn->query($query);

    while ($row = $runQuery->fetchAll(PDO::FETCH_ASSOC)) {
        $result[] = $row;
    }

    //return $result;
    echo(json_encode($result));
}
