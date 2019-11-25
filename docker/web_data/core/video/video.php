<?php

function getVideos($userid=false)
{
    $mysql = new MySqlClient("tables/video.php");
    try 
    {
        $mysql->connect();

        if ($userid == false)
        {
            $mysql->prepare("getAllVideos");
            $results = $mysql->getRows();
        } 
        else
        {
            $mysql->prepare("getUserVideos");
            $results = $mysql->getRows([$userid]);
        }
    
        $formattedResults = formatResults($results);

        return $formatted_results;

    } 
    catch (PDOException $e)
    {
        return $e.getCode();
    }
    
}

function getVideo($videoID)
{
    $mysql = new MySqlClient("tables/video.php");
    try
    {
        $mysql->connect();
        $mysql->prepare("getVideo");
        $result = $mysql->exec();

        return $result;

    } 
    catch (PDOException $e)
    {
        return $e.getCode();
    }
}



function addVideo($video)
{
    $mysql = new MySqlClient("tables/video.php");
    try
    {
        $mysql->connect();
        $mysql->prepare("addVideo");
        if($mysql->exec($video))
        {
            return true;
        } 
        else
        {
            return false;
        } 
    
    } catch(PDOException $e)
    {
        return $e.getCode();
    }

}


function formatResults($results)
{
    $formatted_results = json_encode($results);

    return $formatted_results;
}




?>