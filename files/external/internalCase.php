<?php require_once(INCLUDES . 'header.php');

$player = Functions::GetPlayer();
?>
<link rel="stylesheet" href="/public/css/case.css">

<?php require_once(INCLUDES . 'data.php'); ?>

<div class="page case">
<div class="case-container styleUpdate noselect">
<div class="loader" style="display: none;">
<div class="content">
<i class="fa fa-cog fa-spin"></i><br>
Loading
</div>
</div>
<div class="background" style="filter: hue-rotate(292.765deg) blur(var(--blurStrength));"></div>
<div class="mainInventory inventory" style="display: flex;">
<div class="content">
<div class="tabs system">
<div class="tab active">Inventory</div>
<div class="seperator"></div>
<div class="tab">History</div>
<div class="seperator"></div>
<div class="tab">Trade Up</div>
</div>
<div class="tabs filter">
<div class="tab active" data-tab="all">All</div>
<div class="tab" data-tab="case">Case</div>
<div class="tab" data-tab="key">Key</div>
<div class="tab" data-tab="gift">Gift</div>
</div>
<div class="items ps-container ps-theme-default" data-ps-id="3707f054-ede3-df55-a8ce-05db04466b5f"><div class="noItemInfo"><div class="info">No items found</div></div><div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
</div>
<div class="selectionInventory inventory">
<div class="content">
<div class="controls">
<div class="button grey"><i class="fas fa-arrow-left"></i></div>
<div class="info"><span>SELECT ITEM FOR USE WITH:</span><img src="/do_img/global/items/case/xmas3-case_100x100.png"><span class="itemName">★ Xmas-Gift ★</span></div>
</div>
<div class="items ps-container ps-theme-default" data-ps-id="3421ed41-adcb-1c9b-3a82-8f487aab0a45"><div class="noItemInfo"><div class="info">No matching items found</div></div><div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>
</div>
<div class="casepreview" style="display: none;">
<div class="mask"></div>
<div class="content">
<div class="upperInfo">
<div class="title">Open case</div>
<div class="description">This container can only be opened once</div>
</div>
<div class="main">
<div class="caseImage">
<img src="/do_img/global/items/case/xmas3-case_100x100.png">
</div>
<div class="opener" style="display: none;">
<div class="default">
<div class="spinner outer">
<div class="items" style="transition: transform 0ms ease 0s; transform: matrix(1, 0, 0, 1, 0, 0);"><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/generator/shield/sg3n-b03_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/generator/shield/sg3n-am_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div></div>
</div>
</div>
<div class="zoom">
<div class="spinner zoomed">
<div class="items" style="transition: transform 0ms ease 0s; transform: matrix(1, 0, 0, 1, 0, 0);"><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/generator/shield/sg3n-b03_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/generator/shield/sg3n-am_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item pink">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item yellow">
							<div class="inner">
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item red">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div><div class="item purple">
							<div class="inner">
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="band"></div>
							</div>
						</div></div>
</div>
</div>
<div class="pointer"></div>
</div>
</div>
<div class="itemInfo">
<div class="upperInfo">
<div class="textInfo">Items that could be in this container:</div>
<div class="chatShowSetting">
<input class="chatMessageCheckbox" type="checkbox">
<div class="checkBoxLabel">Show found items in chat</div>
</div>
</div>
<div class="itemList ps-container ps-theme-default ps-active-y" data-ps-id="2cbc2dcb-ad9f-541a-fd35-6ebb4f7ebda2"><div class="item purple" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/booty-key_100x100.png">
									</div>
								</div>
								<div class="percentage">23.5 %</div>
							</div>
							<div class="text">55x Booty key</div>
						</div><div class="item purple" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/resource/extra-energy_100x100.png">
									</div>
								</div>
								<div class="percentage">23.4 %</div>
							</div>
							<div class="text">3000x Extra Energy</div>
						</div><div class="item pink" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="percentage">10 %</div>
							</div>
							<div class="text">LF-4</div>
						</div><div class="item red" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="percentage">7.5 %</div>
							</div>
							<div class="text">LF-4 Paritydrill</div>
						</div><div class="item red" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="percentage">7.5 %</div>
							</div>
							<div class="text">LF-4 Hyperplasmoid</div>
						</div><div class="item red" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="percentage">7.5 %</div>
							</div>
							<div class="text">LF-4 Superplasmoid</div>
						</div><div class="item red" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="percentage">7.5 %</div>
							</div>
							<div class="text">LF-4 Magmadrill</div>
						</div><div class="item red" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									
									<div class="image">
										<img src="/do_img/global/items/equipment/generator/shield/sg3n-b03_100x100.png">
									</div>
								</div>
								<div class="percentage">7.5 %</div>
							</div>
							<div class="text">SG3N-B03 shield</div>
						</div><div class="item yellow" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/generator/shield/sg3n-am_100x100.png">
									</div>
								</div>
								<div class="percentage">1 %</div>
							</div>
							<div class="text">★ SG3N-Antimatter shield ★</div>
						</div><div class="item yellow" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4_100x100.png">
									</div>
								</div>
								<div class="percentage">2 %</div>
							</div>
							<div class="text">★ LF-4 (lvl: 16) ★</div>
						</div><div class="item yellow" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-pd_100x100.png">
									</div>
								</div>
								<div class="percentage">0.5 %</div>
							</div>
							<div class="text">★ LF-4 Paritydrill (lvl: 16) ★</div>
						</div><div class="item yellow" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-hp_100x100.png">
									</div>
								</div>
								<div class="percentage">0.5 %</div>
							</div>
							<div class="text">★ LF-4 Hyperplasmoid (lvl: 16) ★</div>
						</div><div class="item yellow" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-sp_100x100.png">
									</div>
								</div>
								<div class="percentage">0.5 %</div>
							</div>
							<div class="text">★ LF-4 Superplasmoid (lvl: 16) ★</div>
						</div><div class="item yellow" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/weapon/laser/lf-4-md_100x100.png">
									</div>
								</div>
								<div class="percentage">0.5 %</div>
							</div>
							<div class="text">★ LF-4 Magmadrill (lvl: 16) ★</div>
						</div><div class="item yellow" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/generator/shield/sg3n-b03_100x100.png">
									</div>
								</div>
								<div class="percentage">0.5 %</div>
							</div>
							<div class="text">★ SG3N-B03 shield (lvl: 16) ★</div>
						</div><div class="item yellow" data-hash="0">
							<div class="inner">
								<div class="band"></div>
								<div class="content">
									<div class="shine"><video object-fit="fill" width="100%" height="100%" loop="" autoplay="" muted="" oncanplay="this.muted=true"><source src="/do_img/global/case/shine.webm" type="video/webm"></video></div>
									<div class="image">
										<img src="/do_img/global/items/equipment/generator/shield/sg3n-am_100x100.png">
									</div>
								</div>
								<div class="percentage">0.1 %</div>
							</div>
							<div class="text">★ SG3N-Antimatter shield (lvl: 16) ★</div>
						</div><div class="ps-scrollbar-x-rail" style="left: 0px; bottom: -29px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 32px; right: 3px; height: 289px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 29px; height: 260px;"></div></div></div>
</div>
<div class="lowerInfo">
<div class="useInfo"><span>Good luck!</span></div>
<div class="controls">
<div class="button green" style="display: none;">Open gift</div>
<div class="button">CLOSE</div>
</div>
</div>
<div class="flash"></div>
</div>
 </div>
<div class="itemNotifier" style="display: none;">
<div class="content"></div>
</div>
<div class="confetti"> <canvas width="1198" height="598"></canvas></div>
</div>
</div>