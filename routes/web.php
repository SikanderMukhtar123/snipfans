<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ToolsController;
use App\Http\Controllers\frontend\AuthController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\YoutubeVideoDownloader;
use App\Models\tools;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\TitktokController;




route::get('/', [FrontendController::class, 'index'])->name('home');



// Tiktok
route::get('/tiktok-video-downloader', [TitktokController::class, 'index'])->name('tiktok');
route::post('/tiktok-video-downloader', [TitktokController::class, 'request'])->name('tiktok.req');
route::post('/tiktok-video-downloader/views', [TitktokController::class, 'views'])->name('tiktok.views');



// Youtube
route::get('/youtube-video-downloader', [YoutubeVideoDownloader::class, 'index'])->name('youtube');
route::post('/youtube-video-downloader', [YoutubeVideoDownloader::class, 'youtubeRequest'])->name('youtube.req');






// Admin Routes

route::get('/login', [AuthController::class, 'login'])->name('login');
route::post('/login/request', [AuthController::class, 'request'])->name('login.request');




route::middleware(['auth'])->group(function () {

    route::get('/admin', [DashboardController::class, 'index'])->name('admin');



    // admin tools
    route::get('/admin/tools', [ToolsController::class, 'index'])->name('tools');
    route::get('/admin/tools/add', [ToolsController::class, 'add'])->name('tool.add');
    route::post('/admin/tools/save', [ToolsController::class, 'save'])->name('tool.save');
    route::get('/admin/tools/edit/{id}', [ToolsController::class, 'edit'])->name('tool.edit');
    route::post('/admin/tools/update/{id}', [ToolsController::class, 'update'])->name('tool.update');




    // logout
    route::get('/logout', [AuthController::class, 'logout'])->name('logout');


});
