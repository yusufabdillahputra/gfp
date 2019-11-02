@extends('otentikasi.global.index')

@section('title')
    Forbidden | 403
@endsection

@section('content')
    <div class="hero bg-white">
        <div class="hero-inner">
            <div class="content content-full">
                <div class="py-30 text-center">
                    <div class="display-3 text-danger">
                        <i class="fa fa-ban"></i> 403
                    </div>
                    <h1 class="h2 font-w700 mt-30 mb-10">Oops.. Anda tidak memiliki akses..</h1>
                    <h2 class="h3 font-w400 text-muted mb-50">Mohon untuk kembali ke halaman sebelumnya..</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
