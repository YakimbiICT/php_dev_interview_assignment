<?php

include "client.php";
$gate = new Client();

//Start log
$log="";

$data = array();


$randomSelection = json_decode((string) $gate->random()->getBody(), true);

//Save first and second one to favorites
$data['id'] = $randomSelection[0]['id'];
$log .= "First id," .$data['id']." added <br/>";
$log .= '<code type="javascript">';
$log .=$gate->add($data)->getBody();
$log .= '</code><br/>';
$log .= '<br/>';

$data['id'] = $randomSelection[1]['id'];
$log .= "Second id," .$data['id']." added <br/>";
$log .= '<code type="javascript">';
$log .=$gate->add($data)->getBody();
$log .= '</code><br/>';
$log .= '<br/>';

//Delete first
$data['id'] = $randomSelection[0]['id'];
$log .= "First id," .$data['id']." deleted <br/>";
$log .= '<code type="javascript">';
$log .= $gate->delete($data)->getBody();
$log .= '</code><br/>';
$log .= '<br/>';



//Edit the second favortie
$data['id'] = $randomSelection[1]['id'];
$data['title'] = "THIS HAS BEEN EDIT TESTED API CALL";
$log .= "Second favorite's title edited <br/>";
$log .= '<code type="javascript">';
$log .= $gate->edit($data)->getBody();
$log .= '</code><br/>';
$log .= '<br/>';

//Read back the second favorite edited
//Save first and second one to favorites
unset($data['title']);
$log .= "Reading back the second favorites data : <br/>";
$log .= '<code type="javascript">';
$log .= $gate->read($data)->getBody();
$log .= '</code><br/>';
$log .= '<br/>';
$log .= '<br/>';

//Read back the second favorite edited
//Save first and second one to favorites
unset($data['title']);
$log .= "Reading back ALL favorites : <br/>";
$log .= '<code type="javascript">';
$log .= $gate->read()->getBody();
$log .= '</code><br/>';
$log .= '<br/>';



echo $log;