@extends('layouts.abalo')

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Artikeleingabe')

@section('middle')
<div id ="addarticle"></div>
@endsection

