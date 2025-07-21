<?php
// ------------------------------
// 1. include tiny framework
// ------------------------------
$tiny_path = isset($_SERVER['TINY_PATH']) ? tiny::trim($_SERVER['TINY_PATH']) : implode('/', explode('/', __DIR__, -1)) . '/tiny';
require_once $tiny_path . '/tiny.php';

// ------------------------------
// 2. list your jobs
// ------------------------------
// Test job
// tiny::scheduler()->job('Test/job')->everySecond(10);

// Settlements
tiny::scheduler()->job('Settlements/processOnly')->everyTwoMinutes();
// tiny::scheduler()->job('Settlements/processAndCharge')->daily();

// Credits auto-topups
tiny::scheduler()->job('Credits/topups')->everyMinute();

// Subscription credits replenish for special accounts
tiny::scheduler()->job('Replenish/run')->monthly('*', -1, 23, 59);

// ------------------------------
// 3. run the scheduler
// ------------------------------
tiny::scheduler()->run();
// ------------------------------
