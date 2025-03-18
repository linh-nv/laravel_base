@extends('errors::minimal')

@section('title', __('Quyền hạn không đủ!'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: __('Bạn không có quyền truy cập trang này')))

