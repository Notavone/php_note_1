<?php

const DB_HOST = 'localhost';
const DB_USERNAME = 'leoh';
const DB_PASSWORD = '11102002';
const DB_NAME = 'tpnotephp1';

function getConnection(): PDO
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
    $pdo = new PDO($dsn, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

function select(string $sql, array $params): array
{
    $connection = getConnection();
    $statement = $connection->prepare($sql);
    $statement->execute($params);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function update(string $sql, array $params): bool
{
    $connection = getConnection();
    $statement = $connection->prepare($sql);
    $statement->execute($params);
    return $statement->rowCount() > 0;
}

function insert(string $sql, array $params): bool
{
    $connection = getConnection();
    $statement = $connection->prepare($sql);
    $statement->execute($params);
    return $statement->rowCount() > 0;
}

function delete(string $sql, array $params): bool
{
    $connection = getConnection();
    $statement = $connection->prepare($sql);
    $statement->execute($params);
    return $statement->rowCount() > 0;
}