<?php
/**
 * The batch edit view of task module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Congzhi Chen <congzhi@cnezsoft.com>
 * @package     task
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../common/view/header.html.php';?>
<?php include '../../common/view/datepicker.html.php';?>
<?php js::set('dittoNotice', $this->lang->task->dittoNotice);?>
<div id='titlebar'>
  <div class='heading'>
    <span class='prefix'><?php echo html::icon($lang->icons['task']);?></span>
    <strong><small class='text-muted'><?php echo html::icon($lang->icons['batchEdit']);?></small> <?php echo $lang->task->batchEdit . ' ' . $lang->task->common;?></strong>
    <div class='actions'>
      <button type="button" class="btn btn-default" data-toggle="customModal"><i class='icon icon-cog'></i> </button>
    </div>
  </div>
</div>
<?php
$hasFields = array();
foreach(explode(',', $showFields) as $field)
{
    if($field)$hasFields[$field] = '';
}
?>
<form class='form-condensed' method='post' target='hiddenwin' action="<?php echo inLink('batchEdit', "projectID={$projectID}")?>">
  <table class='table table-form table-fixed with-border'>
    <thead>
      <tr>
        <th class='w-50px'><?php echo $lang->idAB;?></th>
        <th <?php if(count($hasFields) > 10) echo "class='w-150px'"?>>   <?php echo $lang->task->name?> <span class='required'></span></th>
        <th class='w-150px<?php echo zget($hasFields, 'module', ' hidden')?>'><?php echo $lang->task->module?></th>
        <th class='w-150px<?php echo zget($hasFields, 'assignedTo', ' hidden')?>'><?php echo $lang->task->assignedTo;?></th>
        <th class='w-80px'><?php echo $lang->typeAB;?> <span class='required'></span></th>
        <th class='w-100px<?php echo zget($hasFields, 'status', ' hidden')?>'><?php echo $lang->task->status;?></th>
        <th class='w-70px<?php echo zget($hasFields, 'pri', ' hidden')?>'><?php echo $lang->task->pri;?></th>
        <th class='w-40px<?php echo zget($hasFields, 'estimate', ' hidden')?>'><?php echo $lang->task->estimateAB;?></th>
        <th class='w-50px<?php echo zget($hasFields, 'record', ' hidden')?>'><?php echo $lang->task->consumedThisTime?></th>
        <th class='w-40px<?php echo zget($hasFields, 'left', ' hidden')?>'><?php echo $lang->task->leftAB?></th>
        <th class='w-90px<?php echo zget($hasFields, 'estStarted', ' hidden')?>'><?php echo $lang->task->estStarted?></th>
        <th class='w-90px<?php echo zget($hasFields, 'deadline', ' hidden')?>'><?php echo $lang->task->deadline?></th>
        <th class='w-100px<?php echo zget($hasFields, 'finishedBy', ' hidden')?>'><?php echo $lang->task->finishedBy;?></th>
        <th class='w-100px<?php echo zget($hasFields, 'canceledBy', ' hidden')?>'><?php echo $lang->task->canceledBy;?></th>
        <th class='w-100px<?php echo zget($hasFields, 'closedBy', ' hidden')?>'><?php echo $lang->task->closedBy;?></th>
        <th class='w-100px<?php echo zget($hasFields, 'closedReason', ' hidden')?>'><?php echo $lang->task->closedReason;?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($taskIDList as $taskID):?>
      <?php
      if(!isset($project))
      {
          $prjInfo = $this->project->getById($tasks[$taskID]->project);
          $modules = $this->tree->getOptionMenu($tasks[$taskID]->project, $viewType = 'task');
          foreach($modules as $moduleID => $moduleName) $modules[$moduleID] = '/' . $prjInfo->name. $moduleName;
          $modules['ditto'] = $this->lang->task->ditto;

          $members          = $this->project->getTeamMemberPairs($tasks[$taskID]->project, 'nodeleted');
          $members['ditto'] = $this->lang->task->ditto;
      }
      ?>
      <tr class='text-center'>
        <td><?php echo $taskID . html::hidden("taskIDList[$taskID]", $taskID);?></td>
        <td title='<?php echo $tasks[$taskID]->name?>'><?php echo html::input("names[$taskID]",        $tasks[$taskID]->name, 'class=form-control');?></td>
        <td class='text-left<?php echo zget($hasFields, 'module', ' hidden')?>' style='overflow:visible'><?php echo html::select("modules[$taskID]",     $modules, $tasks[$taskID]->module, "class='form-control chosen'")?></td>
        <td class='text-left<?php echo zget($hasFields, 'assignedTo', ' hidden')?>' style='overflow:visible'><?php echo html::select("assignedTos[$taskID]", $members, $tasks[$taskID]->assignedTo, "class='form-control chosen'");?></td>
        <td><?php echo html::select("types[$taskID]",    $typeList, $tasks[$taskID]->type, 'class=form-control');?></td>
        <td <?php echo zget($hasFields, 'status', "class='hidden'")?>><?php echo html::select("statuses[$taskID]", $statusList, $tasks[$taskID]->status, 'class=form-control');?></td>
        <td <?php echo zget($hasFields, 'pri', "class='hidden'")?>><?php echo html::select("pris[$taskID]",     $priList, $tasks[$taskID]->pri, 'class=form-control');?></td>
        <td <?php echo zget($hasFields, 'estimate', "class='hidden'")?>><?php echo html::input("estimates[$taskID]", $tasks[$taskID]->estimate, "class='form-control text-center' autocomplete='off'");?></td>
        <td <?php echo zget($hasFields, 'record', "class='hidden'")?>><?php echo html::input("consumeds[$taskID]", '', "class='form-control text-center' autocomplete='off'");?></td>
        <td <?php echo zget($hasFields, 'left', "class='hidden'")?>><?php echo html::input("lefts[$taskID]",     $tasks[$taskID]->left, "class='form-control text-center' autocomplete='off'");?></td>
        <td <?php echo zget($hasFields, 'estStarted', "class='hidden'")?>><?php echo html::input("estStarteds[$taskID]",     $tasks[$taskID]->estStarted, "class='form-control text-center form-date'");?></td>
        <td <?php echo zget($hasFields, 'deadline', "class='hidden'")?>><?php echo html::input("deadlines[$taskID]",     $tasks[$taskID]->deadline, "class='form-control text-center form-date'");?></td>
        <td class='text-left<?php echo zget($hasFields, 'finishedBy', ' hidden')?>' style='overflow:visible'><?php echo html::select("finishedBys[$taskID]", $members, $tasks[$taskID]->finishedBy, "class='form-control chosen'");?></td>
        <td class='text-left<?php echo zget($hasFields, 'canceledBy', ' hidden')?>' style='overflow:visible'><?php echo html::select("canceledBys[$taskID]", $members, $tasks[$taskID]->canceledBy, "class='form-control chosen'");?></td>
        <td class='text-left<?php echo zget($hasFields, 'closedBy', ' hidden')?>' style='overflow:visible'><?php echo html::select("closedBys[$taskID]",   $members, $tasks[$taskID]->closedBy, "class='form-control chosen'");?></td>
        <td <?php echo zget($hasFields, 'closedReason', "class='hidden'")?>><?php echo html::select("closedReasons[$taskID]", $lang->task->reasonList, $tasks[$taskID]->closedReason, 'class=form-control');?></td>
      </tr>
      <?php endforeach;?>

      <?php $columns = count($hasFields) + 3?>
      <?php if(isset($suhosinInfo)):?>
      <tr><td colspan='<?php echo $columns;?>'><div class='f-left blue'><?php echo $suhosinInfo;?></div></td></tr>
      <?php endif;?>
    </tbody>
    <tfoot>
      <tr><td colspan='<?php echo $columns;?>'><?php echo html::submitButton();?></td></tr>
    </tfoot>
  </table>
</form>
<?php $customLink = $this->createLink('custom', 'ajaxSaveCustom', 'module=task&section=custom&key=batchedit')?>
<?php include '../../common/view/customfield.html.php';?>
<?php include '../../common/view/footer.html.php';?>
