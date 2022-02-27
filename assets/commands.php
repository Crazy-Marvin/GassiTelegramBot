<?php
if(strpos($text, "/dog")===0 and ($userId)== True) {
    $command = explode(" ", $text, 2);
    $dogName = $command[1];
    $selectDog = mysqli_query($mysqli, "SELECT * FROM `dog` WHERE `user_id` = '$userId'");
    if($rowDog = mysqli_fetch_assoc($selectDog)) {
        sendMessage($chatId, "❗️ You've already added a dog.");
    } else {
        if(empty($dogName)) {
            sendMessage($chatId, "❗️ The field cannot be empty.");
        } else {
            $currentTime = time();
            $insertDogs = mysqli_query($mysqli, "INSERT INTO `$_ENV['MYSQL_DB']`.`dog` (`user_id`, `name`) VALUES ('$userId', '$dogName')");
            $insertPoop = mysqli_query($mysqli, "INSERT INTO `$_ENV['MYSQL_DB']`.`poop` (`user_id`, `number`, `date`, `note`) VALUES ('$userId', '0', '$currentTime', NULL)");
            $insertPee = mysqli_query($mysqli, "INSERT INTO `$_ENV['MYSQL_DB']`.`pee` (`user_id`, `number`, `date`, `note`) VALUES ('$userId', '0', '$currentTime', NULL)");
            sendMessage($chatId, "🐕 I have added <b>$dogName</b> to the dogs list.");
        }
    }
}

if($text == "/love") {
    $url = "https://dog.ceo/api/breeds/image/random";
    $JSONFile = file_get_contents($url);
    $JSONarray = json_decode($JSONFile, True);
    $random = reset($JSONarray);
    sendPhoto($chatId, $random);
}

if(strpos($text, "/poop")===0 and ($userId)== True) {
    $command = explode(" ", $text, 2);
    $dogNote = $command[1];
    $selectDog = mysqli_query($mysqli, "SELECT * FROM `poop` WHERE `user_id` = '$userId'");
    if($rowDog = mysqli_fetch_assoc($selectDog)) {
        $recordNumber = $rowDog["number"];
        $formulaNumber = $recordNumber + 1;
        $currentTime = time();
        $updateDogs = mysqli_query($mysqli, "UPDATE `poop` SET `number` = '$formulaNumber', `date` = '$currentTime', `note` = '$dogNote' WHERE `poop`.`user_id` = $userId");
        sendMessage($chatId, "💩 I have added new <b>poop</b>.");
    } else {
        sendMessage($chatId, "❗️ You need to add a dog before using this command.");
    }
}

if(strpos($text, "/pee")===0 and ($userId)== True) {
    $command = explode(" ", $text, 2);
    $dogNote = $command[1];
    $selectDog = mysqli_query($mysqli, "SELECT * FROM `pee` WHERE `user_id` = '$userId'");
    if($rowDog = mysqli_fetch_assoc($selectDog)) {
        $recordNumber = $rowDog["number"];
        $formulaNumber = $recordNumber + 1;
        $currentTime = time();
        $updateDogs = mysqli_query($mysqli, "UPDATE `pee` SET `number` = '$formulaNumber', `date` = '$currentTime', `note` = '$dogNote' WHERE `pee`.`user_id` = $userId");
        sendMessage($chatId, "💩 I have added new <b>pee</b>.");
    } else {
        sendMessage($chatId, "❗️ You need to add a dog before using this command.");
    }
}

if(strpos($text, "/vaccinations")===0 and ($userId)== True) {
    $command = explode(" ", $text, 3);
    $vaccinationName = $command[1];
    $vaccinationDate = $command[2];
    $selectDog = mysqli_query($mysqli, "SELECT * FROM `dog` WHERE `user_id` = '$userId'");
    if($rowDog = mysqli_fetch_assoc($selectDog)) {
        if(empty($vaccinationName)) {
            sendMessage($chatId, "❗️ The field cannot be empty.");
        } else {
            $insertVaccination = mysqli_query($mysqli, "INSERT INTO `$_ENV['MYSQL_DB']`.`vaccination` (`id`, `user_id`, `name`, `date`) VALUES (NULL, '$userId', '$vaccinationName', '$vaccinationDate')");
            sendMessage($chatId, "💉 I have added new <b>vaccination</b>.");
        }
    } else {
        sendMessage($chatId, "❗️ You need to add a dog before using this command.");
    }
}

if(strpos($text, "/enemies")===0 and ($userId)== True) {
    $command = explode(" ", $text, 3);
    $enemiesName = $command[1];
    $enemiesNote = $command[2];
    $selectDog = mysqli_query($mysqli, "SELECT * FROM `dog` WHERE `user_id` = '$userId'");
    if($rowDog = mysqli_fetch_assoc($selectDog)) {
        if(empty($enemiesName)) {
            sendMessage($chatId, "❗️ The field cannot be empty.");
        } else {
            $insertEnemies = mysqli_query($mysqli, "INSERT INTO `$_ENV['MYSQL_DB']`.`enemies` (`id`, `user_id`, `name`, `note`) VALUES (NULL, '$userId', '$enemiesName', '$enemiesNote')");
            sendMessage($chatId, "⚔️ I have added new <b>enemy</b>.");
        }
    } else {
        sendMessage($chatId, "❗️ You need to add a dog before using this command.");
    }
}

if(strpos($text, "/medicines")===0 and ($userId)== True) {
    $command = explode(" ", $text, 4);
    $medicinesName = $command[1];
    $medicinesDate = $command[2];
    $medicinesNote = $command[3];
    $selectDog = mysqli_query($mysqli, "SELECT * FROM `dog` WHERE `user_id` = '$userId'");
    if($rowDog = mysqli_fetch_assoc($selectDog)) {
        if(empty($medicinesName) OR (empty($medicinesDate))) {
            sendMessage($chatId, "❗️ The field cannot be empty.");
        } else {
            $insertMedicines = mysqli_query($mysqli, "INSERT INTO `$_ENV['MYSQL_DB']`.`medicines` (`id`, `user_id`, `name`, `date`, `note`) VALUES (NULL, '$userId', '$medicinesName', '$medicinesDate', '$medicinesNote')");
            sendMessage($chatId, "💊 I have added new <b>medicines</b>.");
        }
    } else {
        sendMessage($chatId, "❗️ You need to add a dog before using this command.");
    }
}

if(strpos($text, "/care")===0 and ($userId)== True) {
    $command = explode(" ", $text, 2);
    $careNote = $command[1];
    $selectDog = mysqli_query($mysqli, "SELECT * FROM `dog` WHERE `user_id` = '$userId'");
    if($rowDog = mysqli_fetch_assoc($selectDog)) {
        if(empty($careNote)) {
            sendMessage($chatId, "❗️ The field cannot be empty.");
        } else {
            $insertCare = mysqli_query($mysqli, "INSERT INTO `$_ENV['MYSQL_DB']`.`care` (`id`, `user_id`, `note`) VALUES (NULL, '$userId', '$careNote')");
            sendMessage($chatId, "🛁 I have added new <b>care</b>.");
        }
    } else {
        sendMessage($chatId, "❗️ You need to add a dog before using this command.");
    }
}

if(strpos($text, "/training")===0 and ($userId)== True) {
    $command = explode(" ", $text, 4);
    $trainingName = $command[1];
    $trainingDate = $command[2];
    $trainingNote = $command[3];
    $selectDog = mysqli_query($mysqli, "SELECT * FROM `dog` WHERE `user_id` = '$userId'");
    if($rowDog = mysqli_fetch_assoc($selectDog)) {
        if(empty($trainingName) OR (empty($trainingDate))) {
            sendMessage($chatId, "❗️ The field cannot be empty.");
        } else {
            $insertTraining = mysqli_query($mysqli, "INSERT INTO `$_ENV['MYSQL_DB']`.`training` (`id`, `user_id`, `name`, `date`, `note`) VALUES (NULL, '$userId', '$trainingName', '$trainingDate', '$trainingNote')");
            sendMessage($chatId, "🦮 I have added new <b>training</b>.");
        }
    } else {
        sendMessage($chatId, "❗️ You need to add a dog before using this command.");
    }
}

if($text == "/last") {
    $selectDog = mysqli_query($mysqli, "SELECT * FROM `dog` WHERE `user_id` = '$userId'");
    if($rowDog = mysqli_fetch_assoc($selectDog)) {
        $selectPoop = mysqli_query($mysqli, "SELECT * FROM `poop` WHERE `user_id` = '$userId'");
        $rowPoop = mysqli_fetch_assoc($selectPoop);
        $recordPoopNumber = $rowPoop["number"];
        $selectPee = mysqli_query($mysqli, "SELECT * FROM `pee` WHERE `user_id` = '$userId'");
        $rowPee = mysqli_fetch_assoc($selectPee);
        $recordPeeNumber = $rowPee["number"];
        $selectEnemies = mysqli_query($mysqli, "SELECT * FROM `enemies` WHERE `user_id` = '$userId' ORDER BY `enemies`.`id` DESC");
        $rowEnemies = mysqli_fetch_assoc($selectEnemies);
        $recordEnemiesName = $rowEnemies["name"];
        $recordEnemiesNote = $rowEnemies["note"];
        $selectVaccinations = mysqli_query($mysqli, "SELECT * FROM `vaccination` WHERE `user_id` = '$userId' ORDER BY `vaccination`.`id` DESC");
        $rowVaccinations = mysqli_fetch_assoc($selectVaccinations);
        $recordVaccinationsName = $rowVaccinations["name"];
        $recordVaccinationsDate = $rowVaccinations["date"];
        $selectMedicines = mysqli_query($mysqli, "SELECT * FROM `medicines` WHERE `user_id` = '$userId' ORDER BY `medicines`.`id` DESC");
        $rowMedicines = mysqli_fetch_assoc($selectMedicines);
        $recordMedicinesName = $rowMedicines["name"];
        $recordMedicinesDate = $rowMedicines["date"];
        $recordMedicinesNote = $rowMedicines["note"];
        $selectCare = mysqli_query($mysqli, "SELECT * FROM `care` WHERE `user_id` = '$userId' ORDER BY `care`.`id` DESC");
        $rowCare = mysqli_fetch_assoc($selectCare);
        $recordCareNote = $rowCare["note"];
        $selectTraining = mysqli_query($mysqli, "SELECT * FROM `training` WHERE `user_id` = '$userId' ORDER BY `training`.`id` DESC");
        $rowTraining = mysqli_fetch_assoc($selectTraining);
        $recordTrainingName = $rowTraining["name"];
        $recordTrainingDate = $rowTraining["date"];
        $recordTrainingNote = $rowTraining["note"];
        sendMessage($chatId, "<b>LAST ENTRY</b>:

<b>Poop (last update)</b>: $recordPoopNumber
<b>Pee (last update)</b>: $recordPeeNumber
<b>Enemies -></b> $recordEnemiesName | $recordEnemiesNote
<b>Vaccinations -></b> $recordVaccinationsName | $recordVaccinationsDate
<b>Medicines -></b> $recordMedicinesName | $recordMedicinesDate | $recordMedicinesNote
<b>Care -></b> $recordCareNote
<b>Training -></b> $recordTrainingName | $recordTrainingDate | $recordTrainingNote");
    } else {
        sendMessage($chatId, "❗️ You need to add a dog before using this command.");
    }
}

if($text == "/profile") {
    $selectDog = mysqli_query($mysqli, "SELECT * FROM `dog` WHERE `user_id` = '$userId'");
    if($rowDog = mysqli_fetch_assoc($selectDog)) {
        $recordDogName = $rowDog["name"];
        $selectPoop = mysqli_query($mysqli, "SELECT * FROM `poop` WHERE `user_id` = '$userId'");
        $rowPoop = mysqli_fetch_assoc($selectPoop);
        $recordPoopNumber = $rowPoop["number"];
        $selectPee = mysqli_query($mysqli, "SELECT * FROM `pee` WHERE `user_id` = '$userId'");
        $rowPee = mysqli_fetch_assoc($selectPee);
        $recordPeeNumber = $rowPee["number"];
        $selectEnemies = mysqli_query($mysqli, "SELECT * FROM `enemies` WHERE `user_id` = '$userId' ORDER BY `enemies`.`id` DESC");
        $numEnemies = mysqli_num_rows($selectEnemies);
        $fileEnemiesClear = file_put_contents("/var/www/html/dog/file/enemies.txt", "");
        $i = 1;
        while ($i <= $numEnemies) {
            $rowEnemies = mysqli_fetch_assoc($selectEnemies);
            $recordEnemiesName = $rowEnemies["name"];
            $recordEnemiesNote = $rowEnemies["note"];
            $fileEnemiesOpen = fopen("/var/www/html/dog/file/enemies.txt", "a+");
            $fileEnemiesWrite = fwrite($fileEnemiesOpen, "- $recordEnemiesName | $recordEnemiesNote\n");
            $fileEnemiesClose = fclose($fileEnemiesOpen);
            $i++;
        }
        $resultEnemies = file_get_contents("/var/www/html/dog/file/enemies.txt");
        $selectVaccinations = mysqli_query($mysqli, "SELECT * FROM `vaccination` WHERE `user_id` = '$userId' ORDER BY `vaccination`.`id` DESC");
        $numVaccinations = mysqli_num_rows($selectVaccinations);
        $fileVaccinationsClear = file_put_contents("/var/www/html/dog/file/vaccination.txt", "");
        $y = 1;
        while ($y <= $numVaccinations) {
            $rowVaccinations = mysqli_fetch_assoc($selectVaccinations);
            $recordVaccinationsName = $rowVaccinations["name"];
            $recordVaccinationsDate = $rowVaccinations["date"];
            $fileVaccinationsOpen = fopen("/var/www/html/dog/file/vaccination.txt", "a+");
            $fileVaccinationsWrite = fwrite($fileVaccinationsOpen, "- $recordVaccinationsName ($recordVaccinationsDate)\n");
            $fileVaccinationsClose = fclose($fileVaccinationsOpen);
            $y++;
        }
        $resultVaccinations = file_get_contents("/var/www/html/dog/file/vaccination.txt");
        $selectTraining = mysqli_query($mysqli, "SELECT * FROM `training` WHERE `user_id` = '$userId' ORDER BY `training`.`id` DESC");
        $numTraining = mysqli_num_rows($selectTraining);
        $fileTrainingClear = file_put_contents("/var/www/html/dog/file/training.txt", "");
        $z = 1;
        while ($z <= $numTraining) {
            $rowTraining = mysqli_fetch_assoc($selectTraining);
            $recordTrainingName = $rowTraining["name"];
            $recordTrainingDate = $rowTraining["date"];
            $recordTrainingNote = $rowTraining["note"];
            $fileTrainingOpen = fopen("/var/www/html/dog/file/training.txt", "a+");
            $fileTrainingWrite = fwrite($fileTrainingOpen, "- $recordTrainingName ($recordVaccinationsDate) | $recordTrainingNote\n");
            $fileTrainingClose = fclose($fileTrainingOpen);
            $z++;
        }
        $resultTraining = file_get_contents("/var/www/html/dog/file/training.txt");
        $selectMedicines = mysqli_query($mysqli, "SELECT * FROM `medicines` WHERE `user_id` = '$userId' ORDER BY `medicines`.`id` DESC");
        $numMedicines = mysqli_num_rows($selectMedicines);
        $fileMedicinesClear = file_put_contents("/var/www/html/dog/file/medicines.txt", "");
        $m = 1;
        while ($m <= $numMedicines) {
            $rowMedicines = mysqli_fetch_assoc($selectMedicines);
            $recordMedicinesName = $rowMedicines["name"];
            $recordMedicinesDate = $rowMedicines["date"];
            $recordMedicinesNote = $rowMedicines["note"];
            $fileMedicinesOpen = fopen("/var/www/html/dog/file/medicines.txt", "a+");
            $fileMedicinesWrite = fwrite($fileMedicinesOpen, "- $recordMedicinesName ($recordMedicinesDate) | $recordMedicinesNote\n");
            $fileMedicinesClose = fclose($fileMedicinesOpen);
            $m++;
        }
        $resultMedicines = file_get_contents("/var/www/html/dog/file/medicines.txt");
        $selectCare = mysqli_query($mysqli, "SELECT * FROM `care` WHERE `user_id` = '$userId' ORDER BY `care`.`id` DESC");
        $numCare = mysqli_num_rows($selectCare);
        $fileCareClear = file_put_contents("/var/www/html/dog/file/care.txt", "");
        $f = 1;
        while ($f <= $numCare) {
            $rowCare = mysqli_fetch_assoc($selectCare);
            $recordCareNote = $rowCare["note"];
            $fileCareOpen = fopen("/var/www/html/dog/file/care.txt", "a+");
            $fileCareWrite = fwrite($fileCareOpen, "- $recordCareNote\n");
            $fileCareClose = fclose($fileCareOpen);
            $f++;
        }
        $resultCare = file_get_contents("/var/www/html/dog/file/care.txt");
        sendMessage($chatId, "🐕 <code>[$recordDogName]</code>:

💩 <b>Poop (last update)</b>: $recordPoopNumber
💩 <b>Pee (last update)</b>: $recordPeeNumber

⚔️ <b>Enemies</b>:
$resultEnemies
💉 <b>Vaccinations</b>:
$resultVaccinations
💊 <b>Medicines</b>:
$resultMedicines
🦮 <b>Training</b>:
$resultTraining
🛁 <b>Care</b>:
$resultCare");
    } else {
        sendMessage($chatId, "❗️ You need to add a dog before using this command.");
    }
}
?>