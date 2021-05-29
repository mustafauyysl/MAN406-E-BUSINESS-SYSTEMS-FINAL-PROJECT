<?php

try {
	$db = new PDO("mysql:host=localhost;dbname=gotur;charset=utf8", 'root', 'mu231423');
} catch (PDOExpception $e) {
	echo $e->getMessage();
}
