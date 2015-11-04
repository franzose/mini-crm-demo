@extends('crm.layouts.master')
@section('page-title', 'Новый сотрудник')
@section('content-title', 'Новый сотрудник')
@section('content')
    @include('crm.partials.users.form', [
        'user' => $user,
        'action' => 'store'
    ])
@stop