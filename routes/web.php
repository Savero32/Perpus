<?php

use App\Livewire\HomeComponent;
use App\Livewire\LoginComponent;
use App\Livewire\UserComponent;
use App\Livewire\MemberComponent;
use App\Livewire\KategoriComponent;
use App\Livewire\BukuComponent;
use App\Livewire\PinjamComponent;
use App\Livewire\KembaliComponent;

use Illuminate\Support\Facades\Route;

Route::get('/', HomeComponent::class)->middleware('auth')->name('home');
Route::get('/user', UserComponent::class)->middleware('auth')->name('user');
Route::get('/member', MemberComponent::class)->middleware('auth')->name('member');
Route::get('/kategori', KategoriComponent::class)->middleware('auth')->name('kategori');
Route::get('/login', LoginComponent::class)->name('login');
Route::get('/logout', [LoginComponent::class, 'keluar'])->name('logout');
Route::get('/buku', BukuComponent::class)->middleware('auth')->name('buku');
Route::get('/pinjam', PinjamComponent::class)->middleware('auth')->name('pinjam');
Route::get('/kembali', KembaliComponent::class)->middleware('auth')->name('kembali');
