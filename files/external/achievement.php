<?php require_once(INCLUDES . 'header.php'); ?>
<script src="https://kit.fontawesome.com/4f90b43f8c.js" crossorigin="anonymous" type="text/javascript"></script>
<link rel="stylesheet" href="/css/quest2.css" />
<?php require_once(INCLUDES . 'data.php'); ?>






</style>
<div class="row ">

<div class="col col-12 col-md-6 col-lg-5">
<div class="card">
<span class="corner-border-top"></span>
<span class="corner-border-bottom"></span>
<div class="card-header border-0">
<ul class="nav nav-tabs nav-fill nav-tabs-alt nav-justified">
<li class="nav-item">
<a href="#tab2" data-toggle="tab" aria-expanded="false" class="nav-link active">
<i class="fad fa-scroll-old"></i>
</a>
</li>
<li class="nav-item">
</ul>
</div>
<div class="tab-content " style="max-height: 40vh; overflow: auto; overflow-x: hidden; padding: 0;">
<div class="tab-pane fade" id="ov" aria-expanded="true">
<div class="card-body" style="background: linear-gradient(to top, rgba(10, 13, 22, 1) 30%, rgba(10, 13, 22, 0.5)), url(3/styles/theme/galaxy/header/gaia.webp?v=1630270414) center / cover no-repeat;">
<div class="row">
<div class="col-12 col-md-6 mb-0 mb-md-2 text-left">
<div class="col-12 btn btn-xs btn-light planetname" name="name"><div style="background: url(https://starzone.se/img/ranks/rank_2.png);height: 16px;float: left;width: 16px; margin-right:5px;"></div> ULTRON</div>
</div>
<div class="col-12 col-md-6 mb-0 mb-md-2 text-right">
<a href="index.php?action=christmas_calendar" onclick="return Dialog.open(this.href, 800);" data-toggle="tab" aria-expanded="false" class="btn btn-info">🎅</a> <a href="index.php?action=company_instant" onclick="return Dialog.open(this.href, 700, function() { location.reload(); });" data-toggle="tab" aria-expanded="false" class="btn btn-danger"><i class="fa fa-retweet"></i></a> <a href="#" id="snowButton" onclick="manageSnow(); return false;" data-toggle="tab" aria-expanded="false" class="btn btn-success"><i class="fa fa-snowflake"></i></a>
</div>
<div class="col-12">
<table class="table table-dark bg-transparent w-100">
<tbody><tr>
<td class="h5 py-0 px-1 text-center border-0 bg-transparent" data-toggle="popover" data-trigger="hover focus" data-html="true" data-title="" data-content="User ID" data-original-title="" title="">
<i class="fal fa-id-badge"></i>
</td>
<td class="h6 py-0 px-1 text-left border-0 bg-transparent">
259 </td>
<td class="h5 py-0 px-1 text-center border-0 bg-transparent" data-toggle="popover" data-trigger="hover focus" data-html="true" data-title="" data-content="GGs Maked Today" data-original-title="" title="">
<i class="fal fa-solar-system"></i>
</td>
<td class="h6 py-0 px-1 text-left border-0 bg-transparent">
<span data-toggle="popover" data-trigger="hover focus" data-html="true" data-title="" data-content="Reset at " data-original-title="" title="">0 / 10 Galaxy Gates</span>
</td>
</tr>
<tr>
<td class="h5 py-0 px-1 text-center border-0 bg-transparent" data-toggle="popover" data-trigger="hover focus" data-html="true" data-title="" data-content="Rankpoint left to reach next rank" data-original-title="" title="">
<i class="fas fa-level-up-alt"></i>
</td>
<td class="h6 py-0 px-1 text-left border-0 bg-transparent">
<span class="text-success">6</span>
</td>
<td class="h5 py-0 px-1 text-center border-0 bg-transparent" data-toggle="popover" data-trigger="hover focus" data-html="true" data-title="" data-content="MMO Players" data-original-title="" title="">
<i class="fa fa-asterisk"></i>
</td>
<td class="h6 py-0 px-1 text-left border-0 bg-transparent">
1076 total players in MMO (Online: 6)
</td>
</tr>
<tr>
<td class="h5 py-0 px-1 text-center border-0 bg-transparent" data-toggle="popover" data-trigger="hover focus" data-html="true" data-title="" data-content="Clan" data-original-title="" title="">
<i class="fas fa-users"></i>
</td>
<td class="h6 py-0 px-1 text-left border-0 bg-transparent">
shghss </td>
<td class="h5 py-0 px-1 text-center border-0 bg-transparent" data-toggle="popover" data-trigger="hover focus" data-html="true" data-title="" data-content="VRU Players" data-original-title="" title="">
<i class="fa fa-asterisk"></i>
</td>
<td class="h6 py-0 px-1 text-left border-0 bg-transparent">
900 total players in VRU (Online: 6)
</td>
</tr>
<tr>
<td class="h5 py-0 px-1 text-center border-0 bg-transparent" data-toggle="popover" data-trigger="hover focus" data-html="true" data-title="" data-content="Map" data-original-title="" title="">
<i class="far fa-map-marker"></i>
</td>
<td class="h6 py-0 px-1 text-left border-0 bg-transparent">
- 
</td>
<td class="h5 py-0 px-1 text-center border-0 bg-transparent" data-toggle="popover" data-trigger="hover focus" data-html="true" data-title="" data-content="EIC Players" data-original-title="" title="">
<i class="fa fa-asterisk"></i>
</td>
<td class="h6 py-0 px-1 text-left border-0 bg-transparent">
1047 total players in EIC (Online: 5)
</td>
</tr>
<tr>
<td class="h5 py-0 px-1 text-center border-0 bg-transparent" data-toggle="popover" data-trigger="hover focus" data-html="true" data-title="" data-content="Rank" data-original-title="" title="">
<i class="far fa-star"></i>
</td>
<td class="h6 py-0 px-1 text-left border-0 bg-transparent">
Space Pilot
</td>
<td class="h5 py-0 px-1 text-center border-0 bg-transparent" data-toggle="popover" data-trigger="hover focus" data-html="true" data-title="" data-content="Server Time" data-original-title="" title="">
<i class="fa fa-clock"></i>
</td>
<td class="h6 py-0 px-1 text-left border-0 bg-transparent">
<span id="ssTime">16:15:05</span> Server Time
</td>
</tr>
<tr>
<td class="h5 py-0 px-1 text-center border-0 bg-transparent" data-toggle="popover" data-trigger="hover focus" data-html="true" data-title="" data-content="Premium" data-original-title="" title="">
<i class="far fa-info-square"></i>
</td>
<td class="h6 py-0 px-1 text-left border-0 bg-transparent">
<i class="fa fa-times"></i> </td>
</tr>
</tbody></table>
</div>
</div>
</div>
</div>
<div class="tab-pane fade " id="tab1" aria-expanded="true">
<div class="card-body">
<div class="tab-content">
<div class="tab-pane fade active show" id="defenseList" aria-expanded="true">
<div class="row">
</div>
</div>
</div>
</div>
</div>
<div class="tab-pane fade active show" id="tab2" aria-expanded="true">
<div id="accordionQuest" class="AchievementsK15"> <div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> StreuneR <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to ..::{ StreuneR}::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
250.000 uridium<br>
10 ec<br>
40.000 honor<br>
1.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss StreuneR <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to -=[ Boss streuneR ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
500.000 uridium<br>
20 ec<br>
80.000 honor<br>
2.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Kristallin <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to -=[ Kristallin ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
750.000 uridium<br>
30 ec<br>
160.000 honor<br>
3.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss Kristallin <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to ..::{ Boss Kristallin }::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.000.000 uridium<br>
40 ec<br>
320.000 honor<br>
4.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Kristallon <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to -=[ Kristallon ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.250.000 uridium<br>
80 ec<br>
1.280.000 honor<br>
5.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss Kristallon <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to ..::{ Boss Kristallon }::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.500.000 uridium<br>
90 ec<br>
2.560.000 honor<br>
6.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Protegit <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to -=[ Protegit]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.750.000 uridium<br>
100 ec<br>
5.120.000 honor<br>
7.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Cubikon <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to ..::{Cubikon}::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
2.000.000 uridium<br>
120 ec<br>
10.240.000 honor<br>
8.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Sibelonit <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to -=[ Sibelonit ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
750.000 uridium<br>
30 ec<br>
160.000 honor<br>
3.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss Sibelonit <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to ..::( Boss Sibelonit )::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.000.000 uridium<br>
40 ec<br>
320.000 honor<br>
4.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Lordakium <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to -=[ Lordakium ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.250.000 uridium<br>
80 ec<br>
1.280.000 honor<br>
5.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss Lordakium <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to ..::( Boss Lordakium )::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.500.000 uridium<br>
90 ec<br>
2.560.000 honor<br>
6.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Uber-Streuner <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to [ Uber-Streuner ]</h6>
<hr>
<h6>Reward: <div class="mt-2">
400.000 uridium<br>
15 ec<br>
75.000 honor<br>
1.200.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Uber-Lordakia <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to [ Uber-Lordakia ]</h6>
<hr>
<h6>Reward: <div class="mt-2">
750.000 uridium<br>
30 ec<br>
160.000 honor<br>
3.500.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Uber-Saimon <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to [ Uber-Saimon ]</h6>
<hr>
<h6>Reward: <div class="mt-2">
850.000 uridium<br>
35 ec<br>
220.000 honor<br>
4.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Uber-Mordon <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to [ Uber-Mordon ]</h6>
<hr>
<h6>Reward: <div class="mt-2">
950.000 uridium<br>
40 ec<br>
260.000 honor<br>
4.500.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Uber-Devolarium <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to [ Uber-Devolarium ]</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.250.000 uridium<br>
40 ec<br>
500.000 honor<br>
5.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Uber-Sibelonit <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to [ Uber-Sibelonit ]</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.000.000 uridium<br>
35 ec<br>
320.000 honor<br>
3.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Uber-Lordakium <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to [ Uber-Lordakium ]</h6>
<hr>
<h6>Reward: <div class="mt-2">
2.500.000 uridium<br>
115 ec<br>
5.000.000 honor<br>
8.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Uber-StreuneR <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to [ Uber-StreuneR ]</h6>
<hr>
<h6>Reward: <div class="mt-2">
650.000 uridium<br>
25 ec<br>
120.000 honor<br>
3.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Uber Kristallin <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to Uber Kristallin</h6>
<hr>
<h6>Reward: <div class="mt-2">
2.000.000 uridium<br>
70 ec<br>
850.000 honor<br>
6.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Uber-Kristallon <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to [ Uber-Kristallon ]</h6>
<hr>
<h6>Reward: <div class="mt-2">
2.500.000 uridium<br>
120 ec<br>
6.260.000 honor<br>
10.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Uber Sibelon <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to [ Uber Sibelon ]</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.350.000 uridium<br>
50 ec<br>
420.000 honor<br>
4.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Ice Meteorit <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to Ice Meteorit</h6>
<hr>
<h6>Reward: <div class="mt-2">
7.000.000 uridium<br>
150 ec<br>
15.000.000 honor<br>
15.500.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Impulse II <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to Impulse II</h6>
<hr>
<h6>Reward: <div class="mt-2">
2.000.000 uridium<br>
40 ec<br>
2.000.000 honor<br>
2.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Attend XI <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to Attend XI</h6>
<hr>
<h6>Reward: <div class="mt-2">
4.000.000 uridium<br>
60 ec<br>
4.000.000 honor<br>
4.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Invoke XVI <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to Invoke XVI</h6>
<hr>
<h6>Reward: <div class="mt-2">
5.000.000 uridium<br>
130 ec<br>
10.000.000 honor<br>
12.500.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Mindfire Behemoth <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to Mindfire Behemoth</h6>
<hr>
<h6>Reward: <div class="mt-2">
10.000.000 uridium<br>
200 ec<br>
20.000.000 honor<br>
25.000.000 credits<br>
Berserker-Borealis design<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Interceptor <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to -=[ Interceptor ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
650.000 uridium<br>
20 ec<br>
750.000 honor<br>
1.500.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Barracuda <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to -=[ Barracuda ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
950.000 uridium<br>
25 ec<br>
1.200.000 honor<br>
2.500.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Saboteur <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to -=[ Saboteur ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.150.000 uridium<br>
30 ec<br>
1.700.000 honor<br>
3.500.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Annihilator <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to -=[ Annihilator ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.650.000 uridium<br>
35 ec<br>
2.250.000 honor<br>
4.500.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Battleray <span class="small text-muted">(0/50)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 50 times to -=[ Battleray ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
2.650.000 uridium<br>
40 ec<br>
2.750.000 honor<br>
6.500.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> StreuneR (2) <span class="small text-muted">(0/100)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>StreuneR</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 100 times to ..::{ StreuneR}::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
500.000 uridium<br>
20 ec<br>
80.000 honor<br>
2.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> StreuneR (3) <span class="small text-muted">(0/200)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>StreuneR (2)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 200 times to ..::{ StreuneR}::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.000.000 uridium<br>
40 ec<br>
160.000 honor<br>
4.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> StreuneR (4) <span class="small text-muted">(0/400)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>StreuneR (3)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 400 times to ..::{ StreuneR}::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
2.000.000 uridium<br>
80 ec<br>
320.000 honor<br>
8.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> StreuneR (5) <span class="small text-muted">(0/800)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>StreuneR (4)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 800 times to ..::{ StreuneR}::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
4.000.000 uridium<br>
160 ec<br>
640.000 honor<br>
16.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> StreuneR (6) <span class="small text-muted">(0/1000)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>StreuneR (5)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 1000 times to ..::{ StreuneR}::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
8.000.000 uridium<br>
320 ec<br>
1.280.000 honor<br>
32.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss StreuneR (2) <span class="small text-muted">(0/100)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Boss StreuneR</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 100 times to -=[ Boss streuneR ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.000.000 uridium<br>
40 ec<br>
160.000 honor<br>
4.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss StreuneR (3) <span class="small text-muted">(0/200)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Boss StreuneR (2)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 200 times to -=[ Boss streuneR ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
2.000.000 uridium<br>
80 ec<br>
320.000 honor<br>
8.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss StreuneR (4) <span class="small text-muted">(0/400)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Boss StreuneR (3)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 400 times to -=[ Boss streuneR ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
4.000.000 uridium<br>
160 ec<br>
640.000 honor<br>
16.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss StreuneR (5) <span class="small text-muted">(0/800)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Boss StreuneR (4)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 800 times to -=[ Boss streuneR ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
8.000.000 uridium<br>
320 ec<br>
1.280.000 honor<br>
32.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss StreuneR (6) <span class="small text-muted">(0/1000)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Boss StreuneR (5)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 1000 times to -=[ Boss streuneR ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
16.000.000 uridium<br>
640 ec<br>
2.560.000 honor<br>
64.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Kristallin (2) <span class="small text-muted">(0/100)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Kristallin</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 100 times to -=[ Kristallin ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
1.500.000 uridium<br>
60 ec<br>
320.000 honor<br>
6.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Kristallin (3) <span class="small text-muted">(0/200)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Kristallin (2)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 200 times to -=[ Kristallin ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
3.000.000 uridium<br>
120 ec<br>
640.000 honor<br>
12.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Kristallin (4) <span class="small text-muted">(0/400)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Kristallin (3)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 400 times to -=[ Kristallin ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
6.000.000 uridium<br>
240 ec<br>
1.280.000 honor<br>
24.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Kristallin (5) <span class="small text-muted">(0/800)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Kristallin (4)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 800 times to -=[ Kristallin ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
12.000.000 uridium<br>
480 ec<br>
2.560.000 honor<br>
48.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Kristallin (6) <span class="small text-muted">(0/1000)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Kristallin (5)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 1000 times to -=[ Kristallin ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
24.000.000 uridium<br>
960 ec<br>
5.120.000 honor<br>
96.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss Kristallin (2) <span class="small text-muted">(0/100)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Boss Kristallin</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 100 times to ..::{ Boss Kristallin }::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
2.000.000 uridium<br>
80 ec<br>
640.000 honor<br>
8.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss Kristallin (3) <span class="small text-muted">(0/200)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Boss Kristallin (2)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 200 times to ..::{ Boss Kristallin }::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
4.000.000 uridium<br>
160 ec<br>
1.280.000 honor<br>
16.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss Kristallin (4) <span class="small text-muted">(0/400)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Boss Kristallin (3)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 400 times to ..::{ Boss Kristallin }::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
8.000.000 uridium<br>
320 ec<br>
2.560.000 honor<br>
32.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss Kristallin (5) <span class="small text-muted">(0/800)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Boss Kristallin (4)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 800 times to ..::{ Boss Kristallin }::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
16.000.000 uridium<br>
640 ec<br>
5.120.000 honor<br>
64.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss Kristallin (6) <span class="small text-muted">(0/1000)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Boss Kristallin (5)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 1000 times to ..::{ Boss Kristallin }::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
32.000.000 uridium<br>
1.280 ec<br>
10.240.000 honor<br>
128.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Kristallon (2) <span class="small text-muted">(0/100)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Kristallon</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 100 times to -=[ Kristallon ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
2.500.000 uridium<br>
160 ec<br>
2.560.000 honor<br>
10.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Kristallon (3) <span class="small text-muted">(0/200)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Kristallon (2)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 200 times to -=[ Kristallon ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
5.000.000 uridium<br>
320 ec<br>
5.120.000 honor<br>
20.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Kristallon (4) <span class="small text-muted">(0/400)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Kristallon (3)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 400 times to -=[ Kristallon ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
10.000.000 uridium<br>
640 ec<br>
10.240.000 honor<br>
40.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Kristallon (5) <span class="small text-muted">(0/800)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Kristallon (4)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 800 times to -=[ Kristallon ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
20.000.000 uridium<br>
1.280 ec<br>
20.480.000 honor<br>
80.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Kristallon (6) <span class="small text-muted">(0/1000)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Kristallon (5)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 1000 times to -=[ Kristallon ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
40.000.000 uridium<br>
2.560 ec<br>
40.960.000 honor<br>
160.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Emperor (1) <span class="small text-muted">(0/10)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 10 times to ..::{ Emperor-Sibelon }::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
10.000 uridium<br>
30.000 credits<br>
100 ec<br>
5.000 honor<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Emperor (2) <span class="small text-muted">(0/20)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Emperor (1)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 20 times to ..::{ Emperor-Sibelon }::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
20.000 uridium<br>
60.000 credits<br>
100 ec<br>
5.000 honor<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Emperor (3) <span class="small text-muted">(0/40)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Emperor (2)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 40 times to ..::{ Emperor-Sibelon }::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
30.000 uridium<br>
70.000 credits<br>
100 ec<br>
5.000 honor<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Emperor (4) <span class="small text-muted">(0/80)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Emperor (3)</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 80 times to ..::{ Emperor-Sibelon }::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
40.000 uridium<br>
80.000 credits<br>
100 ec<br>
6.000 honor<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Lordakium (2) <span class="small text-muted">(0/100)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Lordakium</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 100 times to -=[ Lordakium ]=-</h6>
<hr>
<h6>Reward: <div class="mt-2">
10.000.000 credits<br>
2.560.000 honor<br>
160 ec<br>
2.500.000 uridium<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> Boss Lordakium (2) <span class="small text-muted">(0/100)</span> <span style="color:red; margin-left:15px;">First complete the task: <b>Boss Lordakium</b></span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Kill 100 times to ..::( Boss Lordakium )::..</h6>
<hr>
<h6>Reward: <div class="mt-2">
12.000.000 credits<br>
5.120.000 honor<br>
180 ec<br>
3.000.000 uridium<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> GG Alpha 15 times <span class="small text-muted">(0/15)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Make 15 times the gg portal Alpha.</h6>
<hr>
<h6>Reward: <div class="mt-2">
15.000.000 uridium<br>
115 ec<br>
10.000.000 honor<br>
50.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> GG Beta 15 times <span class="small text-muted">(0/15)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Make 15 times the gg portal Beta.</h6>
<hr>
<h6>Reward: <div class="mt-2">
25.000.000 uridium<br>
150 ec<br>
20.000.000 honor<br>
80.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> GG Gamma 15 times <span class="small text-muted">(0/15)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Make 15 times the gg portal Gamma.</h6>
<hr>
<h6>Reward: <div class="mt-2">
35.000.000 uridium<br>
200 ec<br>
30.000.000 honor<br>
120.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> GG Delta 15 times <span class="small text-muted">(0/15)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Make 15 times the gg portal Delta.</h6>
<hr>
<h6>Reward: <div class="mt-2">
37.500.000 uridium<br>
225 ec<br>
37.000.000 honor<br>
65.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> GG Kappa 15 times <span class="small text-muted">(0/15)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Make 15 times the gg portal Kappa.</h6>
<hr>
<h6>Reward: <div class="mt-2">
22.000.000 uridium<br>
100 ec<br>
16.000.000 honor<br>
30.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> JPB 3 times <span class="small text-muted">(0/3)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Make 3 times the jpb event.</h6>
<hr>
<h6>Reward: <div class="mt-2">
10.000.000 uridium<br>
10.000.000 honor<br>
45.000.000 credits<br>
200 ec<br>
Orcus-neikos design<br>
</div>
</h6>
</div>
</div>
</div>
<div class="card mb-0">
<div class="card-header-inherit border-0">
<div class="float-left align-left"><i class="fas fa-scroll-old"></i> GG Hades 15 times <span class="small text-muted">(0/15)</span> </div>
<div class="float-right align-right"></div>
</div>
<div id="cTutorial" class="collapse active show" aria-labelledby="hTutorial" data-parent="#accordionQuest">
<div class="card-body">
<h6 class="text-justify">Make 15 times the gg portal Hades.</h6>
<hr>
<h6>Reward: <div class="mt-2">
22.000.000 uridium<br>
100 ec<br>
8.000.000 honor<br>
30.000.000 credits<br>
</div>
</h6>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
