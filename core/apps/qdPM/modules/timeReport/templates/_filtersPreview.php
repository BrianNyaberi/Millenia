<?php
/**
* WORK SMART
*/
?>
<div class="panel panel-info filter-preview">
<div class="panel-heading"><?php include_component('timeReport','filters',array('action_name'=>$sf_context->getActionName()))?></div>

<?php if(count($filter_by)>0): ?>
<ul class="list-group">
<?php 
$count = 0;
foreach($filter_tables as $table=>$title): 

if(!isset($filter_by[$table])) continue;

if($count>5){ echo '</tr><tr>'; $count=0;}
$count++

?>    
    <li class="list-group-item filter-preview-item">
      <div class="filterPreviewBox">
        <table>
          <tr>
            <td valign="top" style="padding-top: 2px;"><?php echo link_to('<i class="fa fa-times"></i>','timeReport/' . $action_name . '?remove_filter=' . $table . ($params? '&' . $params:''),array('title'=>__('Remove Filter'),'class'=>'btn btn-default btn-xs'))?></td>
            <td valign="top"><div id="filtersPreviewMenuBox">
            <?php 
                        
                switch($table)
                {
                  case 'TasksStatus':  $m =  app::getFilterMenuStatusItemsByTable(array(),$table,'Status','timeReport/' . $action_name,$params,$filter_by[$table]);
                    break;
                  case 'TasksAssignedTo':  $m =  app::getFilterMenuUsers(array(),$table,'Assigned To','timeReport/' . $action_name,$params,$filter_by[$table]);
                    break;
                  case 'TasksCreatedBy':  $m =  app::getFilterMenuUsers(array(),$table,'Created By','timeReport/' . $action_name,$params,$filter_by[$table]);
                    break;
                  case 'Projects':  $m =  app::getFilterProjects(array(),'timeReport/' . $action_name,$params,$filter_by[$table],$sf_user); 
                    break;                  
                  default: $m = app::getFilterMenuItemsByTable(array(),$table,$title,'timeReport/' . $action_name,$params,$filter_by[$table],$sf_user);                 
                    break;
                }
                
                echo renderYuiMenu('filtersMenu' . $table,$m);
                 
                
            ?></div></td>
            <td valign="middle" class="selectedFilterItems"><?php echo (strstr($table,'extraField')? $filter_by[$table] : app::getNameByTableId($table,$filter_by[$table]))?></td>
          </tr>
        </table>
      </div>
      
      <script type="text/javascript">
          YAHOO.util.Event.onContentReady("filtersMenu<?php echo $table ?>", function () {
              var oMenuBar = new YAHOO.widget.MenuBar("filtersMenu<?php echo $table ?>", {autosubmenudisplay: true,hidedelay: 350,submenuhidedelay: 0,scrollincrement:10,showdelay: 150,keepopen: true,lazyload: true });
              oMenuBar.render();
          });
      </script>
      
    </li>
<?php endforeach ?> 
   
</ul>
<?php endif ?>
</div>      


<div class="panel panel-info filter-preview" style="padding: 5px;">
<?php include_component('timeReport','extraFilters',array('filter_by'=>$filter_by,'action_name'=>$sf_context->getActionName())) ?>
</div>
