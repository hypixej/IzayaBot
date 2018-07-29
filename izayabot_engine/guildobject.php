<?php
$outputtohtml .= "<table>";
$outputtohtml .= "<tr>";
$outputtohtml .= "<td>Owner ID</td>";
$outputtohtml .= "<td>" . $fetchedarray['owner_id'] . "</td>";
$outputtohtml .= "</tr>";
$outputtohtml .= "<tr>";
$outputtohtml .= "<td>Guild ID</td>";
$outputtohtml .= "<td>" . $fetchedarray['id'] . "</td>";
$outputtohtml .= "</tr>";
$outputtohtml .= "<tr>";
$outputtohtml .= "<td>Guild Name</td>";
$outputtohtml .= "<td>" . $fetchedarray['name'] . "</td>";
$outputtohtml .= "</tr>";
$outputtohtml .= "<tr>";
$outputtohtml .= "<td>Icon</td>";
$outputtohtml .= "<td>" . qicon($fetchedarray['id'], $fetchedarray['icon']) . "</td>";
$outputtohtml .= "</tr>";
$outputtohtml .= "<tr>";
$outputtohtml .= "<td>Voice Region</td>";
$outputtohtml .= "<td>" . $fetchedarray['region'] . "</td>";
$outputtohtml .= "</tr>";
$outputtohtml .= "<tr>";
$outputtohtml .= "<td>verification_level</td>";
$outputtohtml .= "<td>" . $fetchedarray['verification_level'] . "</td>";
$outputtohtml .= "</tr>";
$outputtohtml .= "<tr>";
$outputtohtml .= "<td>mfa_level</td>";
$outputtohtml .= "<td>" . $fetchedarray['mfa_level'] . "</td>";
$outputtohtml .= "</tr>";
$outputtohtml .= "<tr>";
$outputtohtml .= "<td>Roles</td>";
$outputtohtml .= "<td><table>";
usort($fetchedarray['roles'], function($a, $b) {
	return ($a["position"] > $b["position"]) ? -1 : 1;
});
foreach($fetchedarray['roles'] as $onerole){
    $outputtohtml .= "<table style='width: 100%' border='1'>";
    $outputtohtml .= "<tr>";
    $outputtohtml .= "<td>name</td>";
    $outputtohtml .= "<td>" . $onerole['name'] . "</td>";
    $outputtohtml .= "</tr>";
    $outputtohtml .= "<tr>";
    $outputtohtml .= "<td>permissions</td>";
    $outputtohtml .= "<td>" . $onerole['permissions'] . "</td>";
    $outputtohtml .= "</tr>";
    $outputtohtml .= "</table>";
}
$outputtohtml .= "</table></td>";
$outputtohtml .= "</tr>";
$outputtohtml .= "</table>";
?>