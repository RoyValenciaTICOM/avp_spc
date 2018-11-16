<?php

 ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Usuarios del Centro de Captura') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle del Usuario');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit-centro', $coUser->co_user_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?= $this->Form->postLink(__('<i class="fa fa-trash-o" ></i>'), ['action' => 'delete-centro', $coUser->co_user_id], ['class' => 'btn btn-default ','rel' => 'tooltip','title'=>'Eliminar','escape' => false,'confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $coUser->co_user_id)]) ?>
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add-centro'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index-centro'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Usuarios','escape' => false)); ?> 
                     </div>
                               
                                                 
                   </div> 
                </div>
            </div>
            <br>      
             <div class="">
                 <table class="table table-striped table-detalle" style="width: 100%;">
                  <tbody>
                    
                   
                    <tr>
                        <td class="field"><?= __('Login') ?></td>
                        <td><?= h($coUser->login) ?></td>
                    </tr>
                   
                    <tr>
                        <td class="field"><?= __('Nombre') ?></td>
                        <td><?= h($coUser->nombre) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Centro de Captura') ?></td>
                        <td><?= h($coUser->centros_captura->descripcion) ?></td>
                    </tr>
                   
                        <tr>
                        <td class="field"><?= __('Activo') ?></td>
                        <td><?= $coUser->active ? 'Si' : 'No' ?></td>
                    </tr>
                    
                    <tr>
                        <td class="field"><?= __('Ult. imicio de sesión') ?></td>
                        <td><?= h($coUser->last_login) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Email') ?></td>
                        <td><?= h($coUser->email) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('F. Alta') ?></td>
                        <td><?= h($coUser->created) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('F. Modificado') ?></td>
                        <td><?= h($coUser->modified) ?></td>
                    </tr>
              </tbody>  
            </table>
             </div>
 
             </div>
          </div>
               
        </div>
    </div>
</div>    