<?php

function dbGetConnection() {
    static $connection = null;
    if ( $connection !== null ) {
        return $connection;
    }

    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASS = 'root';
    $DB_NAME = '20191019_catalog';
    $connection = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    if (!$connection) {
        throw new Exception('Не удалось установить соединение с базой данных', 500);
    }
    mysqli_set_charset($connection, 'utf8');

    return $connection;
}

function dbInsert(string $tableName, array $data) {
    $fields = [];
    $values = [];

    foreach ($data as $field => $value) {
        $fields[] = '`' . $field . '`';
        $values[] = dbPrepareValue($value);        
    }
    $fields = implode(', ', $fields);
    $values = implode(', ', $values);
    $query = "INSERT INTO `$tableName` ($fields) VALUES ($values);";

    return mysqli_query(dbGetConnection(), $query);
}

// [
//     'fio' => 'Иван',
//     'phone' => '+7 900 100-20-30'
// ]
function dbUpdate(string $tableName, array $data, string $condition) {
    $changes = [];
    foreach ($data as $key => $value) {
        $changes[] = "`{$key}` = " . dbPrepareValue($value);
    }
    $updateQuery = "UPDATE `$tableName` SET " . implode(', ', $changes) . " WHERE {$condition};";
    return mysqli_query(dbGetConnection(), $updateQuery);
}

function dbPrepareValue($value) {
    if ( is_numeric($value) ) {
        return $value;
    } else if ( is_bool($value) ) {
        return (int) $value;
    } else {
        $value = mysqli_escape_string(dbGetConnection(), $value);
        return "'" . $value . "'";
    }
}

// Возвращает id последней добавленной записи.
function dbGetLastInsertId() {
    return mysqli_insert_id( dbGetConnection() );
}

function dbGetError() {
    return mysqli_error( dbGetConnection() );
}

function dbResultSelect(string $tableName, string $fields, string $condition = '') {
    $condition = empty($condition) ? '' : 'WHERE '.$condition;
    $query = "SELECT {$fields} FROM `{$tableName}` {$condition};";
    return mysqli_query( dbGetConnection(), $query );
}

// Выборка одной записи (первой попавшейся)
function dbSelectFirstRow(string $tableName, string $fields = '*', string $condition = '') {
    $result = dbResultSelect($tableName, $fields, $condition);
    return mysqli_fetch_assoc($result);
}

// Выборка всех записей
function dbSelectAll(string $tableName, string $fields = '*', string $condition = '') {
    $result = dbResultSelect($tableName, $fields, $condition);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Выборка всех записей по SQL-запросу
function dbSelectAllByQuery(string $query) {
    $result = mysqli_query( dbGetConnection(), $query );
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Выборка одной записи (первой) по SQL-запросу
function dbSelectOneByQuery(string $query) {
    $result = mysqli_query( dbGetConnection(), $query );
    return mysqli_fetch_assoc($result);
}

// Тернарный оператор $a = (condition) ? $b : $c;
// $a = (условие) ? значение, если условие верно : значение, если неверно
// if (условие) {
//     return значение, если условие верно;
// } else {
//     return значение, если неверно;
// }