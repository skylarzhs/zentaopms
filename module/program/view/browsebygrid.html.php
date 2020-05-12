<style>#mainMenu{padding-left: 10px; padding-right: 10px;}</style>
<div class='row cell' id='cards'>
  <?php foreach ($projectList as $projectID => $project):?>
  <div class='col' data-id='<?php echo $projectID?>'>
    <div class='panel' data-url='<?php echo $this->createLink('project', 'task', "projectID=$project->id");?>'>
      <div class='panel-heading'>
        <strong class='project-name' title='<?php echo $project->name;?>'><?php echo $project->name;?></strong>
        <?php if($project->type === 'cmmi'): ?>
        <span class='project-type-label label label-warning label-outline'><?php echo $lang->program->cmmi; ?></span>
        <?php else: ?>
        <span class='project-type-label label label-info label-outline'><?php echo $lang->program->scrum; ?></span>
        <?php endif; ?>
        <nav class='panel-actions nav nav-default'>
          <li class='dropdown'>
            <a href='javascript:;' data-toggle='dropdown' class='panel-action'><i class='icon icon-ellipsis-v'></i></a>
            <ul class='dropdown-menu pull-right'>
              <li><?php common::printicon('program', 'activate', "projectid=$project->id", $project, 'button', '', '', 'iframe', true);?></li>
              <li><?php if(common::hasPriv('program', 'edit')) echo html::a($this->createLink("program", "edit", "projectID=$project->id"), "<i class='icon-edit'></i> " . $lang->edit, '', "");?></li>
              <li><?php common::printIcon('program', 'start',   "projectID=$project->id", $project, 'button', '', '', 'iframe', true);?></li>
              <li><?php common::printIcon('program', 'suspend', "projectID=$project->id", $project, 'button', '', '', 'iframe', true);?></li>
              <li><?php common::printIcon('program', 'finish',  "projectID=$project->id", $project, 'button', '', '', 'iframe', true);?></li>
              <li><?php common::printIcon('program', 'close',   "projectID=$project->id", $project, 'button', '', '', 'iframe', true);?></li>
              <li><?php if(common::hasPriv('program', 'delete'))  echo html::a($this->createLink("project", "delete", "projectID=$project->id"), "<i class='icon-trash'></i> " . $lang->delete, 'hiddenwin', "");?></li>
            </ul>
          </li>
        </nav>
      </div>
      <div class='panel-body'>
        <div class='project-infos'>
          <span><i class='icon icon-group'></i> <?php printf($lang->program->membersUnit, $project->teamCount); ?></span>
          <span><i class='icon icon-clock'></i> <?php printf($lang->program->hoursUnit, $project->hours->totalEstimate); ?></span>
          <span><i class='icon icon-cost'></i> <?php echo $project->budget . '' . zget($lang->program->unitList, $project->budgetUnit);?></span>
        </div>
        <?php if($project->type === 'cmmi'): ?>
        <div class='project-detail project-stages'>
          <p class='text-muted'><?php echo $lang->program->ongoingStage; ?></p>
          <div class='label label-outline'><?php echo zget($lang->project->statusList, $project->status);?></div>
        </div>
        <?php else: ?>
        <div class='project-detail project-iteration'>
          <p class='text-muted'><?php echo $lang->program->lastIteration; ?></p>
          <div class='row'>
            <div class='col-xs-5'><?php echo $project->name; ?></div>
            <div class='col-xs-7'>
            <div class="progress progress-text-left">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $project->hours->progress;?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $project->hours->progress;?>%">
              <span class="progress-text"><?php echo $project->hours->progress;?>%</span>
              </div>
            </div>
            </div>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php endforeach;?>
  <div class='col-xs-12' id='cardsFooter'>
    <?php $pager->show('right', 'pagerjs');?>
  </div>
</div>