@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ getAdminPanelUrl("/") }}">{{trans('admin/main.dashboard')}}</a>
                </div>
                <div class="breadcrumb-item">{{ $pageTitle}}</div>
            </div>
        </div>

		<div class="section-body">
            <h2 class="section-title">Pengaturan Aplikasi</h2>
            <p class="section-lead">
                Anda dapat mengubah semua parameter dan variabel menggunakan pilihan dibawah ini.
            </p>

            <div class="row">
                                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-cog"></i>
                            </div>
                            <div class="card-body">
                                <h4>Umum</h4>
                                <p>Ubah judul situs web, logo, bahasa, RTL, akun sosial, gaya desain, pramuat.</p>
                                <a href="{{ getAdminPanelUrl("/settings/general") }}" class="card-cta">Ubah Pengaturan<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                
                                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="card-body">
                                <h4>Finansial</h4>
                                <p>Tentukan komisi, pajak, pembayaran, mata uang, gateway pembayaran, pembayaran offline</p>
                                <a href="{{ getAdminPanelUrl("/settings/financial") }}" class="card-cta">Ubah Pengaturan<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                
                                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-wrench"></i>
                            </div>
                            <div class="card-body">
                                <h4>Personalisasi</h4>
                                <p>Ubah latar belakang halaman, bagian beranda, gaya pahlawan, gambar &amp; teks.</p>
                                <a href="{{ getAdminPanelUrl("/settings/personalization/page_background") }}" class="card-cta">Ubah Pengaturan<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                
                                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div class="card-body">
                                <h4>Notifikasi</h4>
                                <p>Tetapkan templat pemberitahuan untuk proses sistem.</p>
                                <a href="{{ getAdminPanelUrl("/settings/notifications") }}" class="card-cta">Ubah Pengaturan<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                
                                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="card-body">
                                <h4>SEO</h4>
                                <p>Tentukan judul SEO, deskripsi meta, dan akses perayapan mesin pencari untuk setiap halaman.</p>
                                <a href="{{ getAdminPanelUrl("/settings/seo") }}" class="card-cta">Ubah Pengaturan<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                
                                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-list-alt"></i>
                            </div>
                            <div class="card-body">
                                <h4>Coding (advanced)</h4>
                                <p>Tentukan CSS tambahan &amp; JS.</p>
                                <a href="{{ getAdminPanelUrl("/settings/customization") }}" class="card-cta text-primary">Ubah Pengaturan<i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')

@endpush
