<?php

// Startup
require_once(__DIR__ . '\config.php');
require_once(__DIR__ . '\startup.php');

// dotenv
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

// DB
require("db.php");

// APP
include("app.php");