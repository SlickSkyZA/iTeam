<section class="content-header">
    <h1>
        <?=$this->lang->line('panel_title');?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?=$this->lang->line('main_menu')?></a></li>
        <li class="active"><?=$this->lang->line('page_menu')?> page</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
    <?php 
        $usertype = $this->session->userdata("usertype");
        if($usertype){
    ?>
    <div class="col-md-4">
        <div class="box box-info">
            <div class="box-body">
                <div class="box box-solid">

                    <div class="box-header">

                        <i class="fa fa-text-width"></i>

                        <h3 class="box-title"><?php echo $project->project_title ?></h3>
                        <div class="box-tools pull-right">
                            <a class="btn btn-warning btn-sm" href="<?=base_url('project/edit/'.$project->project_id);?>">
                                <i class="fa fa-edit"></i>
                            </a>
                        </div>

                    </div><!-- /.box-header -->
                    <div class="box-body">                                
                        <table style="max-width: 400px;" class="table table-striped table-bordered">

                            <tbody>
                                <tr>
                                    <th colspan="2">Project Details</th>
                                </tr>
                                <tr>
                                    <td><?=$this->lang->line("project_create_date")?></td>
                                    <td><?php  echo $project->project_create_date; ?></td>
                                </tr>
                                <tr>
                                    <td><?=$this->lang->line("project_deadline")?></td>
                                    <td><?php  echo $project->project_deadline; ?></td>
                                </tr>

                                <tr>
                                    <th colspan="2"><?=$this->lang->line("project_description")?></th>                                            
                                </tr>
                                <tr>                                            
                                    <td colspan="2"><?php  echo $project->project_description; ?></td>
                                </tr>
                                <tr>
                                    <td><?=$this->lang->line("project_status")?></td>
                                    <td>
                                        <small class="text-center badge bg-aqua"><?php  echo $project->project_status; ?></small>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2"><?=$this->lang->line("project_progress")?></th>
                                </tr>
                                <tr>                                            
                                    <td colspan="2" class="text-center">
                                        <input type="text" class="knob" value="<?php  echo $project_progress; ?>" data-width="150" data-height="150" data-fgColor="#3c8dbc"/>
                                    </td>
                                </tr>
                            </tbody>    

                        </table>  

                    </div><!-- /.box-body -->
                </div><!-- /.box -->                            
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header">
                <i class="ion ion-clipboard"></i>
                <h3 class="box-title">Tasks</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <ul class="todo-list">
                    <?php if (count($tasks)): ?>
                        <?php foreach ($tasks as $task): ?>
                            <li class="<?php if($task->status==1){?>done<?php } ?>">
                                <!-- drag handle -->
                                <span class="handle">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <i class="fa fa-ellipsis-v"></i>
                                </span>
                                <!-- todo text -->
                                <span class="text"><?=$task->task_title?></span>
                                <!-- Emphasis label -->
                                <small class="label <?php if($task->status==1){?>label-success<?php } else {?>label-danger<?php } ?>" data-toggle="tooltip" data-original-title="Status"><i class="fa fa-clock-o"></i> <?php if($task->status==0){echo "Pending";} else {echo "Complete";}?></small>
                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    <small class="btn <?php if($task->status==1){?>btn-success btn-xs<?php } else {?>btn-danger btn-xs<?php } ?>" data-toggle="tooltip" data-original-title="Change Status"><i class="fa fa-edit"></i> <?php if($task->status==0){echo "Complete";} else {echo "in Process";}?></small>
                                    <small class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash-o"></i></small>
                                </div>                               
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <span class="handle">
                            <i class="fa fa-ellipsis-v"></i>
                            <i class="fa fa-ellipsis-v"></i>
                        </span>
                        <span class="text">No task added yet</span>
                    <?php endif ?>                    
                </ul>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix no-border">
                <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#task"><i class="fa fa-plus"></i> Add item</button>
            </div>
        </div><!-- /.box -->
    </div> 
    <?php if ($this->session->flashdata('error_task')): ?>    
    <div class="col-md-8">
        <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-ban"></i>
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
        <p>Task is not created!</p>
        <?=$this->session->flashdata('error_task');?>
        </div>
    </div>
    <?php endif ?> 
    <?php if ($this->session->flashdata('success_task')): ?>    
    <div class="col-md-8">
        <div class="alert alert-success alert-dismissable">
        <i class="fa fa-ban"></i>
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
        <?=$this->session->flashdata('success_task');?>
        </div>
    </div>
    <?php endif ?>   
    <?php
        }
    ?>
    </div>
</section><!-- /.content -->
<!-- Task adding module -->
<form class="form-horizontal" role="form" method="post" action="<?=base_url('project/add_task/'.$project->project_id);?>">
    <div class="modal fade" id="task">
      <div class="modal-dialog">
        <div class="modal-content" style="width:100%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Add task</h4>
            </div>
            <div class="modal-body">
                <div class='form-group' > 
                    <label for="title" class="col-sm-3 control-label">
                        Title
                    </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="title" name="title" value="<?=set_value('title')?>" >
                    </div>
                    <span class="col-sm-5 control-label" id="title_error">
                    </span>
                </div>
                <div class='form-group'> 
                    <label for="description" class="col-sm-3 control-label">
                        Description
                    </label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="description" name="description" value="<?=set_value('description')?>" ></textarea>                        
                    </div>
                    <span class="col-sm-5 control-label" id="description_error">
                    </span>
                </div>
                <div class='form-group'> 
                    <label for="userID" class="col-sm-3 control-label">
                        Select User
                    </label>
                    <div class="col-sm-8">
                        <select name="userID[]" multiple class="form-control">
                          <?php foreach ($users as $user): ?>
                              <option value="<?=$user->userID?>"><?=$user->name?></option>
                          <?php endforeach ?>
                        </select>                        
                    </div>
                    <span class="col-sm-5 control-label" id="userID_error">
                    </span>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-close" style="margin-bottom:0px;" data-dismiss="modal">Close</button>
                <input type="submit" id="add_task" class="btn btn-success" value="New task" />
            </div>
        </div>
      </div>
    </div>
</form>
<!-- end task module -->
<!-- adding active class at menu item -->
<script>
    $("#project").addClass("active");
</script>





