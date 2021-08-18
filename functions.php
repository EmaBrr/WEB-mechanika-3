<?php

init();

function init(){
    if (!file_exists("./data.txt")) {
        file_put_contents("./data.txt", "[]");
    }
    if (!file_exists("./id.txt")) {
        file_put_contents("./id.txt", 0);
    }

};

function newID() {
    $id = json_decode( file_get_contents("./id.txt") );
    $id++;
    file_put_contents("./id.txt", $id);
    return $id;
};

function store(){
    $data = getData();
    $data[] = [
        "id" => newID(),
        "species" => $_POST["species"],
        "name" => $_POST["name"],
        "age" => $_POST["age"]
    ];
    file_put_contents("./data.txt", json_encode($data));
};

function getData(){
   $data = json_decode( file_get_contents("./data.txt", 1) ); //array - 1
   foreach ($data as &$animal) {
        $animal = (array) $animal;
   }
   return $data;
};

function destroy() {
    $data = getData();
    foreach ($data as $key => $entry) {
        if($entry['id']== $_POST['delete']){
            unset($data[$key]);
            file_put_contents("./data.txt", json_encode(array_values($data)));
            return;
        }
    }   
};

function find($id) {
    $animal;
    $data = getData();
    foreach ($data as $entry) {
        if($entry['id'] == $id){
            $animal = $entry;
            return (array) $animal;
        }
    }   
};

function update() {
    $data = getData();
    $updatedAnimal = [
            "id" => $_POST['update'],
            "species" => $_POST['species'],
            "name" => $_POST['name'],
            "age" => $_POST['age']
    ];
    foreach ($data as &$entry) {
        if($entry['id'] == $updatedAnimal['id']){
            $entry = $updatedAnimal;
            file_put_contents("./data.txt", json_encode($data));
            return;
        }
    }   
};

?>