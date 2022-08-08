@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Settings')

@section('content')

<div class="row"></div>
    <section class="content mt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="card-title">Mijoz Malumotlarini Tahrirlash Bo'limi</h3>
                        </div>
                        <div class="col-lg-6">

                        </div>
                    </div>
                </div>
                <div class="card-body" id="add_customer_blok">
                    {{-- <strong>Filial Nomi</strong> --}}
                    <form action="{{ route('admin.edit_customer_form') }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Mijoz Nomi</button>
                                    </div>
                                    <input type="hidden" name="customer_id" value="{{ $edit_customer->customer_id }}">
                                    <input aria-describedby="customer_name_sm" id="customer_name"
                                        onkeypress="clsAlphaNoOnly(event)" onpaste="return false;" required type="text"
                                        class="form-control @error('customer_name') is-invalid @enderror"
                                        name="customer_name" value="{{ $edit_customer->customer_name }}">
                                    @error('customer_name')
                                        <small id="customer_name_sm" class="form-text text-muted text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Mijoz Manzili</button>
                                    </div>
                                    <input aria-describedby="customer_address_sm" type="text" id="customer_address"
                                        class="form-control @error('customer_address') is-invalid @enderror"
                                        name="customer_address" value="{{ $edit_customer->customer_address }}">
                                    @error('customer_address')
                                        <small id="customer_address_sm" class="form-text text-muted text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Telefon Raqami</button>
                                    </div>
                                    <input aria-describedby="customer_phone_sm" type="text" name="customer_phone"
                                        class="form-control @error('customer_phone') is-invalid @enderror"
                                        data-inputmask='"mask": "99-999-99-99"' data-mask value="{{ $edit_customer->phone_number }}">
                                    @error('customer_phone')
                                        <small id="customer_phone_sm" class="form-text text-muted text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Mijoz Kodi</button>
                                    </div>
                                    <input readonly  aria-describedby="customer_code_sm"  type="text"
                                        id="customer_code" class="form-control @error('customer_code') is-invalid @enderror"
                                        name="customer_code" value="{{ $edit_customer->customer_code }}">
                                    @error('customer_code')
                                        <small id="customer_address_sm" class="form-text text-muted text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-md-6"></div>
                            <div class="col-md-6 text-right">

                                <input type="submit" value="Tasdiqlash" class="btn btn-success">
                                <input type="reset" value="Bekor Qilish" class="btn btn-danger">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
