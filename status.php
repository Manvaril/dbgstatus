<?php
/**
 * File              : status.php
 * Program           : DBG Games Server Status
 * Copyright         : (C) 2016 BlackBlade Software. All Rights Reserved.
 * Project Website   : https://github.com/Manvaril/dbgstatus
 *
 * Last Modified By  : Manvaril
 * Last Modified Date: 10/22/2016
 * File Version:     : 1.0
 *
 */
/*******************************************************************************************/
/**                                     SCRIPT CONFIG                                     **/
/*******************************************************************************************/
// Signup for a Service ID from http://census.daybreakgames.com/#service-id
$service_id = "";

// Game Code (game servers to display)
// DC Universe Online = dcuo
// EverQuest = eq
// EverQuest 2 = eq2
// H1Z1:Just Survive = h1z1
// H1Z1:King of the Kill = h1z1xx
// Landmark = lm
// PlanetSide 2 = ps2
$game_code = "eq";

/*******************************************************************************************/
/**                             DO NOT MODIFY BELOW THIS LINE                             **/
/*******************************************************************************************/
echo "<table>\n";
echo "<tr>\n";
echo "<td>Server Name</td>\n";
echo "<td>Region</td>\n";
echo "<td>Last Response</td>\n";
echo "<td>Status</td>\n";
echo "<td>Population</td>\n";
echo "</tr>\n";
$show_fields = "name,is_public,game_code,game_name,region_name,last_reported_population,last_reported_state,last_reported_time";
$sort_fields = "game_name:1,name:1";
$limit = "1000";

$url = "http://census.daybreakgames.com/" . $service_id . "/json/get/global/game_server_status?c:show=" . $show_fields . "&c:sort=" . $sort_fields . "&game_code=" . $game_code . "&c:limit=" . $limit;

$result = file_get_contents($url);
$server_list = json_decode($result, true);

for ($i = 0; $i < count($server_list['game_server_status_list']); $i++) {
    $datetime1 = date_create(date("m/d/Y j:i:s", time()));
    $datetime2 = date_create(date("m/d/Y j:i:s", $server_list['game_server_status_list'][$i]['last_reported_time']));
    $interval = date_diff($datetime1, $datetime2);
    echo "<tr>\n";
    echo "<td>" . $server_list['game_server_status_list'][$i]['name'] . "</td>\n";
    echo "<td>" . $server_list['game_server_status_list'][$i]['region_name'] . "</td>\n";
    echo "<td>" . $interval->format('%i minutes ago') . "</td>\n";
    if ($server_list['game_server_status_list'][$i]['last_reported_state'] !== 'down') {
        $server_status = "Up";
    } else {
        $server_status = " Down";
    }
    echo "<td>" . $server_status . "</td>\n";
    echo "<td>" . $server_list['game_server_status_list'][$i]['last_reported_state'] . "</td>\n";
    echo "</tr>\n";
}
echo "</table>\n";
/*******************************************************************************************/
/**                             DO NOT MODIFY ABOVE THIS LINE                             **/
/*******************************************************************************************/
?>
