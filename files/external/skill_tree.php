<?php
require_once(INCLUDES . 'header.php');

$equipment = $mysqli->query('SELECT skill_points, items FROM player_equipment WHERE userId = ' . $player['userId'] . '')->fetch_assoc();
$skillPoints = json_decode($equipment['skill_points']);
$skillTree = json_decode($equipment['items'])->skillTree;
$requiredLogdisks = Functions::GetRequiredLogdisks((array_sum((array) $skillPoints) + $skillTree->researchPoints) + 1);

$skills = Functions::GetSkills($skillPoints);
?>

<?php require_once(INCLUDES . 'data.php'); ?>

<link type="text/css" rel="stylesheet" href="/css/materialize.min.css" media="screen,projection" />
<link rel="stylesheet" href="/public/css/skillupdate.css" />
<link type="text/css" rel="stylesheet" href="/css/skill-tree.css"/>

<div class="page pilotSheet ">
<div class="pilotSheet-container styleUpdate">
<div class="loader" style="display: none;">
<div class="content">
<i class="fa fa-cog fa-spin"></i><br>
LOADING </div>
</div>
<div class="items ps-container ps-active-y">
<div class="skills"><span id="researchPoints" style="visibility: hidden;"><?php echo $skillTree->researchPoints; ?></span></h6> 

<h5>SKILL TREE</h5>



<?php foreach ($skills as $key => $value) { ?>
            <div class="skillContainer">
              <div id="<?php echo $key; ?>" class="skill" data-toggle="tooltip" data-placement="bottom" data-animation="true" data-html="true" data-original-title="<?php echo Functions::GetSkillTooltip($value['name'], $value['currentLevel'], $value['maxLevel']); ?>">
                <div class="<?php echo ($value['currentLevel'] == $value['maxLevel'] ? 'skill_effect_max' : (isset($value['baseSkill']) && $skills[$value['baseSkill']]['currentLevel'] != $skills[$value['baseSkill']]['maxLevel'] ? 'skill_effect_inactive' : 'skill_effect')); ?> <?php echo ($skillTree->researchPoints <= 0 ? 'noCursor' : ''); ?> customTooltip type_skillTree loadType_normal id_skill_18a_info inner_skillTreeHorScrollable  outer_profilePage top_120 left_300">
                  <div class="skillPoints <?php echo ($value['currentLevel'] == $value['maxLevel'] ? 'skilltree_font_ismax' : 'skilltree_font_fail_skillPoints'); ?>">
                    <span class="currentLevel"><?php echo $value['currentLevel']; ?></span>/<span class="maxLevel"><?php echo $value['maxLevel']; ?></span>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
</div>



</div>
<div class="resetContainer" data-toggle="tooltip" data-placement="top" data-html="true" title="" data-original-title="Reset all your Skills and get your Researchpoints back for 2.500 U.">
<div id="resetSkills" class="button">
Reset for <?php echo number_format(Functions::GetResetSkillCost($skillTree->resetCount), 0, '.', '.'); ?> U. </div>
</div>
<div class="infoContainer">
<div class="logfiles">
<img src="/do_img/global/items/resource/logfile_63x63.png" data-toggle="tooltip" data-placement="bottom" data-html="true" title="" data-original-title="Logfile">
<a href="" id="logfiles_amount" class="amount"><?php echo $skillTree->logdisks; ?></a>
</div>

</div>
<div class="item-infos">

<div class="action">
<div class="quantity-container">
<span style="text-align:center; font-size: 20;">You have Logfiles  <b id="logfilesNeededForRS">
<div class="input-group-addon currency">
	<?php echo $skillTree->logdisks; ?>
	</div>
</b> </span><br>
</div>
<div class="quantity-container">
<span style="text-align:center; font-size: 20px;">You need <b id="logfilesNeededForRS">
<div class="input-group-addon currency">
<b>	<?php echo $requiredLogdisks; ?></b>
	</div>
	 Logfiles for the next Researchpoint</span><br>
</div>
<br>
<b>Research Points</b>
<div class="input-group">
<div class="input-group-addon currency"><?php echo $skillTree->researchPoints; ?></div>
</div>
<span id="researchPoints" style="visibility: hidden;"><?php echo $skillTree->researchPoints; ?></span>
<b>Research Points used</b>
<div class="input-group">
<div class="input-group-addon currency"><span id="usedResearchPoints"><?php echo array_sum((array) $skillPoints); ?></span>/<?php echo array_sum(array_column($skills, 'maxLevel')); ?></div>
</div>
<br>
<center>
<button id="exchangeLogdisks" class="btn-small grey darken-3 waves-effect waves-light" <?php echo (($skillTree->logdisks < $requiredLogdisks) || ((array_sum((array) $skillPoints) + $skillTree->researchPoints) >= array_sum(array_column($skills, 'maxLevel'))) ? 'disabled' : ''); ?>>EXCHANGE</button>
</div>
</div>
</div>
</div>


<?php require_once(INCLUDES . 'footer.php'); ?>
