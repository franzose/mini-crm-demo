@extends('crm.layouts.master')
@section('page-title', 'Редактирование сотрудника')
@section('content-title', 'Редактирование сотрудника')
@section('content')
    @include('crm.partials.users.form', [
        'user' => $user,
        'action' => 'update'
    ])
@stop