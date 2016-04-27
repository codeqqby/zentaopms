<?php
/**
 * The batch create view of story module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Yangyang Shi <shiyangyang@cnezsoft.com>
 * @package     story
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include './header.html.php';?>
<div id='titlebar'>
  <div class='heading'>
    <span class='prefix'><?php echo html::icon($lang->icons['story']);?></span>
    <strong>
      <small class='text-muted'><?php echo html::icon($lang->icons['batchCreate']);?></small>
      <?php echo $lang->story->batchCreate;?>
      <?php if($product->type !== 'normal') echo '<span class="label label-info">' . $branches[$branch] . '</span>';?>
    </strong>
    <div class='actions'>
      <?php if(common::hasPriv('file', 'uploadImages')) echo html::a($this->createLink('file', 'uploadImages', 'module=story&params=' . helper::safe64Encode("productID=$productID&moduleID=$moduleID")), $lang->uploadImages, '', "data-toggle='modal' data-type='iframe' class='btn' data-width='600px'")?>
      <?php echo html::commonButton($lang->pasteText, "data-toggle='myModal'")?>
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
<form class='form-condensed' method='post' enctype='multipart/form-data' target='hiddenwin'>
  <table class='table table-form table-fixed with-border'> 
    <thead>
      <tr class='text-center'>
        <th class='w-30px'><?php echo $lang->idAB;?></th> 
        <th class='w-p15<?php echo zget($hasFields, 'module', ' hidden')?>'><?php echo $lang->story->module;?></th>
        <th class='w-p15<?php echo zget($hasFields, 'plan', ' hidden')?>'><?php echo $lang->story->plan;?></th>
        <th><?php echo $lang->story->title;?> <span class='required'></span></th>
        <th class='w-80px<?php echo zget($hasFields, 'source', ' hidden')?>'><?php echo $lang->story->source;?></th>
        <th class='w-p15<?php echo zget($hasFields, 'spec', ' hidden')?>'><?php echo $lang->story->spec;?></th>
        <th class='w-p15<?php echo zget($hasFields, 'verify', ' hidden')?>'><?php echo $lang->story->verify;?></th>
        <th class='w-80px<?php echo zget($hasFields, 'pri', ' hidden')?>'><?php echo $lang->story->pri;?></th>
        <th class='w-80px<?php echo zget($hasFields, 'estimate', ' hidden')?>'><?php echo $lang->story->estimate;?></th>
        <th class='w-70px<?php echo zget($hasFields, 'review', ' hidden')?>'><?php echo $lang->story->review;?></th>
        <th class='w-100px<?php echo zget($hasFields, 'keywords', ' hidden')?>'><?php echo $lang->story->keywords;?></th>
      </tr>
    </thead>
    <?php $i = 0; ?>
    <?php if(!empty($titles)):?>
    <?php foreach($titles as $storyTitle => $fileName):?>
    <?php $moduleID = $i == 0 ? $moduleID : 'ditto';?>
    <?php $planID   = $i == 0 ? '' : 'ditto';?>
    <?php $pri      = $i == 0 ? '' : 'ditto';?>
    <?php $source   = $i == 0 ? '' : 'ditto';?>
    <tr class='text-center'>
      <td><?php echo $i+1;?></td>
      <td class='text-left<?php echo zget($hasFields, 'module', ' hidden')?>' style='overflow:visible'><?php echo html::select("module[$i]", $moduleOptionMenu, $moduleID, "class='form-control chosen'");?></td>
      <td class='text-left<?php echo zget($hasFields, 'plan', ' hidden')?>' style='overflow:visible'><?php echo html::select("plan[$i]", $plans, $planID, "class='form-control chosen'");?></td>
      <td><?php echo html::input("title[$i]", $storyTitle, "class='form-control'") . html::hidden("uploadImage[$i]", $fileName);?></td>
      <td class='text-left<?php echo zget($hasFields, 'source', ' hidden')?>'><?php echo html::select("source[$i]", $sourceList, $source, "class='form-control'");?></td>
      <td class='<?php echo zget($hasFields, 'spec', 'hidden')?>'><?php echo html::textarea("spec[$i]", $spec, "rows='1' class='form-control autosize'");?></td>
      <td class='<?php echo zget($hasFields, 'verify', 'hidden')?>'><?php echo html::textarea("verify[$i]", '', "rows='1' class='form-control autosize'");?></td>
      <td class='text-left<?php echo zget($hasFields, 'pri', ' hidden')?>' style='overflow:visible'><?php echo html::select("pri[$i]", $priList, $pri, "class='form-control'");?></td>
      <td class='<?php echo zget($hasFields, 'estimate', 'hidden')?>'><?php echo html::input("estimate[$i]", $estimate, "class='form-control' autocomplete='off'");?></td>
      <td class='<?php echo zget($hasFields, 'review', 'hidden')?>'><?php echo html::select("needReview[$i]", $lang->story->reviewList, $needReview, "class='form-control'");?></td>
      <td class='<?php echo zget($hasFields, 'keywords', 'hidden')?>'><?php echo html::input("keywords[$i]", '', "class='form-control' autocomplete='off'");?></td>
    </tr>
    <?php $i++;?>
    <?php endforeach;?>
    <?php $storyTitle = '';?>
    <?php endif;?>
    <?php $nextStart = $i;?>
    <?php for($i = $nextStart; $i < $config->story->batchCreate; $i++):?>
    <?php $moduleID = $i - $nextStart == 0 ? $moduleID : 'ditto';?>
    <?php $planID   = $i - $nextStart == 0 ? '' : 'ditto';?>
    <?php $pri      = $i - $nextStart == 0 ? '' : 'ditto';?>
    <?php $source   = $i - $nextStart == 0 ? '' : 'ditto';?>
    <tr class='text-center'>
      <td><?php echo $i+1;?></td>
      <td class='text-left<?php echo zget($hasFields, 'module', ' hidden')?>' style='overflow:visible'><?php echo html::select("module[$i]", $moduleOptionMenu, $moduleID, "class='form-control chosen'");?></td>
      <td class='text-left<?php echo zget($hasFields, 'plan', ' hidden')?>' style='overflow:visible'><?php echo html::select("plan[$i]", $plans, $planID, "class='form-control chosen'");?></td>
      <td><?php echo html::input("title[$i]", $storyTitle, "class='form-control'");?></td>
      <td class='text-left<?php echo zget($hasFields, 'source', ' hidden')?>'><?php echo html::select("source[$i]", $sourceList, $source, "class='form-control'");?></td>
      <td class='<?php echo zget($hasFields, 'spec', 'hidden')?>'><?php echo html::textarea("spec[$i]", $spec, "rows='1' class='form-control autosize'");?></td>
      <td class='<?php echo zget($hasFields, 'verify', 'hidden')?>'><?php echo html::textarea("verify[$i]", '', "rows='1' class='form-control autosize'");?></td>
      <td class='text-left<?php echo zget($hasFields, 'pri', ' hidden')?>' style='overflow:visible'><?php echo html::select("pri[$i]", $priList, $pri, "class='form-control'");?></td>
      <td class='<?php echo zget($hasFields, 'estimate', 'hidden')?>'><?php echo html::input("estimate[$i]", $estimate, "class='form-control' autocomplete='off'");?></td>
      <td class='<?php echo zget($hasFields, 'review', 'hidden')?>'><?php echo html::select("needReview[$i]", $lang->story->reviewList, 0, "class='form-control'");?></td>
      <td class='<?php echo zget($hasFields, 'keywords', 'hidden')?>'><?php echo html::input("keywords[$i]", '', "class='form-control' autocomplete='off'");?></td>
    </tr>  
    <?php endfor;?>
    <tr><td colspan='<?php echo count($hasFields) + 2?>' class='text-center'><?php echo html::submitButton() . html::backButton();?></td></tr>
  </table>
</form>
<table class='hide' id='trTemp'>
  <tbody>
    <tr class='text-center'>
      <td>%s</td>
      <td class='text-left<?php echo zget($hasFields, 'module', ' hidden')?>' style='overflow:visible'><?php echo html::select("module[%s]", $moduleOptionMenu, $moduleID, "class='form-control'");?></td>
      <td class='text-left<?php echo zget($hasFields, 'plan', ' hidden')?>' style='overflow:visible'><?php echo html::select("plan[%s]", $plans, $planID, "class='form-control'");?></td>
      <td><?php echo html::input("title[%s]", $storyTitle, "class='form-control'");?></td>
      <td class='text-left<?php echo zget($hasFields, 'source', ' hidden')?>'><?php echo html::select("source[%s]", $sourceList, $source, "class='form-control'");?></td>
      <td class='<?php echo zget($hasFields, 'spec', ' hidden')?>'><?php echo html::textarea("spec[%s]", $spec, "rows='1' class='form-control autosize'");?></td>
      <td class='<?php echo zget($hasFields, 'verify', ' hidden')?>'><?php echo html::textarea("verify[%s]", '', "rows='1' class='form-control autosize'");?></td>
      <td class='text-left<?php echo zget($hasFields, 'pri', ' hidden')?>' style='overflow:visible'><?php echo html::select("pri[%s]", $priList, $pri, "class='form-control'");?></td>
      <td class='<?php echo zget($hasFields, 'estimate', ' hidden')?>'><?php echo html::input("estimate[%s]", $estimate, "class='form-control autocomplete='off''");?></td>
      <td class='<?php echo zget($hasFields, 'review', ' hidden')?>'><?php echo html::select("needReview[%s]", $lang->story->reviewList, 0, "class='form-control'");?></td>
      <td class='<?php echo zget($hasFields, 'keywords', ' hidden')?>'><?php echo html::input("keywords[%s]", '', "class='form-control autocomplete='off''");?></td>
    </tr>
  </tbody>
</table>
<?php $customLink = $this->createLink('custom', 'ajaxSaveCustom', 'module=story&section=custom&key=batchcreate')?>
<?php include '../../common/view/customfield.html.php';?>
<?php include '../../common/view/pastetext.html.php';?>
<?php include '../../common/view/footer.html.php';?>
