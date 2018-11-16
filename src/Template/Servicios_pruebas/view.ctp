<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?= __('Servicios') ?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-th"></i> <?= __('Detalle de  Servicio');?> </h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       
                        <?php echo $this->Html->link('<i class="fa fa-edit"></i>', array('action' => 'edit', $servicio->servicio_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Editar','escape' => false)); ?>
                        <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', array('action' => 'delete',$servicio->servicio_id), array('class' => 'btn btn-default','rel' => 'tooltip','title' => 'Eliminar','escape' => false), __('¿Seguro que desea eliminar el registro # %s?', $servicio->servicio_id)); ?> 
                        <?php echo $this->Html->link('<i class="fa fa-plus" ></i>', array('action' => 'add'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Agregar','escape' => false)); ?>
                        <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Servicios','escape' => false)); ?> 
                     </div>
                             <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'TipoServicios', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Tipo Servicios'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'TipoServicios', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Tipo Servicio '));
                                   
                                 ?>                               
                              </div>    
                                                        <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'TipoIncidencias', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Tipo Incidencias'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'TipoIncidencias', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Tipo Incidencia '));
                                   
                                 ?>                               
                              </div>    
                                                        <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'Prioridades', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Prioridades'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'Prioridades', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Prioridade '));
                                   
                                 ?>                               
                              </div>    
                                                        <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'CatAdscripciones', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Cat Adscripciones'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'CatAdscripciones', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Cat Adscripcione '));
                                   
                                 ?>                               
                              </div>    
                                                        <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'CoUsers', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Co Users'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'CoUsers', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Co User '));
                                   
                                 ?>                               
                              </div>    
                                                        <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'Status', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Status'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'Status', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Status '));
                                   
                                 ?>                               
                              </div>    
                                                        <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'Bitacoraservs', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Bitacoraservs'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'Bitacoraservs', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Bitacoraserv '));
                                   
                                 ?>                               
                              </div>    
                                                        <div class="btn-group pull-right">                                                                   
                                  <?php
                                    echo $this->Html->link( '<i class="fa fa-list-ul"></i>', array('controller' => 'Adjuntos', 'action' => 'index'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Adjuntos'));
                                    echo $this->Html->link( '<i class="fa fa-plus-circle"></i>', array('controller' => 'Adjuntos', 'action' => 'add'), array('class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Adjunto '));
                                   
                                 ?>                               
                              </div>    
                                                 
                   </div> 
                </div>
            </div>
            <br>      
             <div class="">
                 <table class="table table-striped table-detalle" style="width: 100%;">
                  <tbody>
                    <tr>
                        <td class="field"><?= __('Servicio Id') ?></td>
                        <td><?= h($servicio->servicio_id) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Fecha Solicitud') ?></td>
                        <td><?= h($servicio->fecha_solicitud) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Descripcion Corta') ?></td>
                        <td><?= h($servicio->descripcion_corta) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Tipo Servicio') ?></td>
                        <td><?= $servicio->has('tipo_servicio') ? $this->Html->link($servicio->tipo_servicio->descripcion, ['controller' => 'TipoServicios', 'action' => 'view', $servicio->tipo_servicio->tipo_servicio_id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Tipo Incidencia') ?></td>
                        <td><?= $servicio->has('tipo_incidencia') ? $this->Html->link($servicio->tipo_incidencia->descripcion, ['controller' => 'TipoIncidencias', 'action' => 'view', $servicio->tipo_incidencia->tipo_incidencia_id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Problematica') ?></td>
                        <td><?= h($servicio->problematica) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('No Inventario') ?></td>
                        <td><?= h($servicio->no_inventario) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Prioridade') ?></td>
                        <td><?= $servicio->has('prioridade') ? $this->Html->link($servicio->prioridade->descripcion, ['controller' => 'Prioridades', 'action' => 'view', $servicio->prioridade->prioridade_id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Cat Adscripcione') ?></td>
                        <td><?= $servicio->has('cat_adscripcione') ? $this->Html->link($servicio->cat_adscripcione->nom_ads, ['controller' => 'CatAdscripciones', 'action' => 'view', $servicio->cat_adscripcione->cat_adscripcione_id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Nombre Solicitante') ?></td>
                        <td><?= h($servicio->nombre_solicitante) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Cargo Solicitante') ?></td>
                        <td><?= h($servicio->cargo_solicitante) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Telefono Solicitante') ?></td>
                        <td><?= h($servicio->telefono_solicitante) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Email Solicitante') ?></td>
                        <td><?= h($servicio->email_solicitante) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Fecha Limite Solucion') ?></td>
                        <td><?= h($servicio->fecha_limite_solucion) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Co User') ?></td>
                        <td><?= $servicio->has('co_user') ? $this->Html->link($servicio->co_user->clave_nombre, ['controller' => 'CoUsers', 'action' => 'view', $servicio->co_user->co_user_id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Solucion') ?></td>
                        <td><?= h($servicio->solucion) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Fecha Solucion') ?></td>
                        <td><?= h($servicio->fecha_solucion) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Status') ?></td>
                        <td><?= $servicio->has('status') ? $this->Html->link($servicio->status->descripcion, ['controller' => 'Status', 'action' => 'view', $servicio->status->statu_id]) : '' ?></td>
                    </tr>
                                <tr>
                        <td class="field"><?= __('Notas') ?></td>
                        <td><?= h($servicio->notas) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Created') ?></td>
                        <td><?= h($servicio->created) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Modified') ?></td>
                        <td><?= h($servicio->modified) ?></td>
                    </tr>
                    <tr>
                        <td class="field"><?= __('Creador') ?></td>
                        <td><?= $servicio->has('creador') ? $this->Html->link($servicio->creador->clave_nombre, ['controller' => 'CoUsers', 'action' => 'view', $servicio->creador->co_user_id]) : '' ?></td>
                    </tr>
                          </tbody>  
            </table>
             </div>
      <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Related Bitacoraservs') ?></h3>
            <?php if (!empty($servicio->bitacoraservs)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                        <th><?= __('Bitacoraserv Id') ?></th>
                        <th><?= __('Servicio Id') ?></th>
                        <th><?= __('Descripcion Evento') ?></th>
                        <th><?= __('Created') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($servicio->bitacoraservs as $bitacoraservs): ?>
                <tr>
                    <td><?= h($bitacoraservs->bitacoraserv_id) ?></td>
                    <td><?= h($bitacoraservs->servicio_id) ?></td>
                    <td><?= h($bitacoraservs->descripcion_evento) ?></td>
                    <td><?= h($bitacoraservs->created) ?></td>
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                            <?= $this->Html->link(__('Ver'), ['controller' => 'Bitacoraservs', 'action' => 'view', $bitacoraservs->bitacoraserv_id],['class' => 'btn btn-default btn-sm']) ?>
                            <?= $this->Html->link(__('Editar'), ['controller' => 'Bitacoraservs', 'action' => 'edit', $bitacoraservs->bitacoraserv_id],['class' => 'btn btn-default btn-sm']) ?>
                            <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Bitacoraservs', 'action' => 'delete', $bitacoraservs->bitacoraserv_id], ['class' => 'btn btn-default btn-sm','confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $bitacoraservs->bitacoraserv_id)]) ?>
                          </div>  
                       </div> 
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
       </div> 
          <div class="row">
        <div class="related col-sm-10 col-sm-offset-2">
            <h3><?= __('Related Adjuntos') ?></h3>
            <?php if (!empty($servicio->adjuntos)): ?>
            <table class="table" cellpadding="0" cellspacing="0">
                <tr>
                        <th><?= __('Adjunto Id') ?></th>
                        <th><?= __('Servicio Id') ?></th>
                        <th><?= __('Archivo') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($servicio->adjuntos as $adjuntos): ?>
                <tr>
                    <td><?= h($adjuntos->adjunto_id) ?></td>
                    <td><?= h($adjuntos->servicio_id) ?></td>
                    <td><?= h($adjuntos->archivo) ?></td>
                    <td class="actions">
                       <div class="btn-toolbar">
                          <div class="btn-group">
                            <?= $this->Html->link(__('Ver'), ['controller' => 'Adjuntos', 'action' => 'view', $adjuntos->adjunto_id],['class' => 'btn btn-default btn-sm']) ?>
                            <?= $this->Html->link(__('Editar'), ['controller' => 'Adjuntos', 'action' => 'edit', $adjuntos->adjunto_id],['class' => 'btn btn-default btn-sm']) ?>
                            <?= $this->Form->postLink(__('Eliminar'), ['controller' => 'Adjuntos', 'action' => 'delete', $adjuntos->adjunto_id], ['class' => 'btn btn-default btn-sm','confirm' => __('¿Seguro que desea eliminar el registro # {0}?', $adjuntos->adjunto_id)]) ?>
                          </div>  
                       </div> 
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
       </div> 
    
             </div>
          </div>
               
        </div>
    </div>
</div>    