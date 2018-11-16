 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">                      
        <h2><?= __('Servicios');?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5><i class="fa fa-edit"></i> <?= __('Agregar Servicio') ?></h5>                    
               </div>               
            <div class="ibox-content">   
               <div class="row">
                <div class="col-md-12">
                  <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group pull-right"> 
                       <?php echo $this->Html->link('<i class="fa fa-list" ></i>', array('action' => 'index'), array('class' => 'btn btn-default','rel' => 'tooltip','title'=>'Lista de Servicios ','escape' => false)); ?>
                     </div>
                                        <div class="btn-group pull-right">
                           <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> '), ['controller' => 'TipoServicios', 'action' => 'index'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Tipo Servicios']) ?>
                           <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> '), ['controller' => 'TipoServicios', 'action' => 'add'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Tipo Servicio ']) ?>
                       </div>
                                        <div class="btn-group pull-right">
                           <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> '), ['controller' => 'TipoIncidencias', 'action' => 'index'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Tipo Incidencias']) ?>
                           <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> '), ['controller' => 'TipoIncidencias', 'action' => 'add'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Tipo Incidencia ']) ?>
                       </div>
                                        <div class="btn-group pull-right">
                           <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> '), ['controller' => 'Prioridades', 'action' => 'index'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Prioridades']) ?>
                           <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> '), ['controller' => 'Prioridades', 'action' => 'add'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Prioridade ']) ?>
                       </div>
                                        <div class="btn-group pull-right">
                           <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> '), ['controller' => 'CatAdscripciones', 'action' => 'index'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Cat Adscripciones']) ?>
                           <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> '), ['controller' => 'CatAdscripciones', 'action' => 'add'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Cat Adscripcione ']) ?>
                       </div>
                                        <div class="btn-group pull-right">
                           <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> '), ['controller' => 'CoUsers', 'action' => 'index'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Co Users']) ?>
                           <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> '), ['controller' => 'CoUsers', 'action' => 'add'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Co User ']) ?>
                       </div>
                                        <div class="btn-group pull-right">
                           <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> '), ['controller' => 'Status', 'action' => 'index'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Status']) ?>
                           <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> '), ['controller' => 'Status', 'action' => 'add'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Status ']) ?>
                       </div>
                                        <div class="btn-group pull-right">
                           <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> '), ['controller' => 'Bitacoraservs', 'action' => 'index'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Bitacoraservs']) ?>
                           <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> '), ['controller' => 'Bitacoraservs', 'action' => 'add'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Bitacoraserv ']) ?>
                       </div>
                                        <div class="btn-group pull-right">
                           <?= $this->Html->link(__('<i class="fa fa-list-ul"></i> '), ['controller' => 'Adjuntos', 'action' => 'index'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Lista de Adjuntos']) ?>
                           <?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> '), ['controller' => 'Adjuntos', 'action' => 'add'],['class' => 'btn btn-default','escape'=>false,'rel'=>'tooltip', 'title'=>'Nuevo Adjunto ']) ?>
                       </div>
                                       </div> 
                </div>
            </div>
            <br>  
            <?php
              $myTemplates = [
                 'formStart' => '<form{{attrs}} class="form-horizontal">',
                'inputContainer' => '<div class="form-group {{type}}{{required}}">{{content}}</div>',
                'input' => '<div class="col-sm-9"><input type="{{type}}" name="{{name}}" class="form-control" {{attrs}}/></div>',
                'label' => '<label  class="col-sm-3 control-label" {{attrs}}>{{text}}</label>',
                'select' => '<div class="col-sm-9"><select name="{{name}}"{{attrs}} class="form-control">{{content}}</select></div>',
                'selectMultiple' => '<div class="col-sm-9"><select name="{{name}}[]" multiple="multiple"{{attrs}} class="form-control">{{content}}</select></div>',
                'textarea' => '<div class="col-sm-9"><textarea name="{{name}}"{{attrs}} class="form-control">{{value}}</textarea></div>',
                 'checkbox' => '<div class="col-sm-9 checkbox-div"><input type="checkbox" name="{{name}}"  value="{{value}}"{{attrs}}  ></div>',
                'nestingLabel' => '<label class="col-sm-3 control-label checkbox-label" {{attrs}}>{{text}}</label>{{hidden}}{{input}}'
            ];
            $this->Form->templates($myTemplates);     
            ?>      
             <?= $this->Form->create($servicio) ?>
                 <fieldset>
                    <legend></legend>
        <?php
            echo $this->Form->input('fecha_solicitud');
            echo $this->Form->input('descripcion_corta');
            echo $this->Form->input('tipo_servicio_id', ['options' => $tipoServicios]);
            echo $this->Form->input('tipo_incidencia_id', ['options' => $tipoIncidencias]);
            echo $this->Form->input('problematica');
            echo $this->Form->input('no_inventario');
            echo $this->Form->input('prioridade_id', ['options' => $prioridades]);
            echo $this->Form->input('cat_adscripcione_id', ['options' => $catAdscripciones]);
            echo $this->Form->input('nombre_solicitante');
            echo $this->Form->input('cargo_solicitante');
            echo $this->Form->input('telefono_solicitante');
            echo $this->Form->input('email_solicitante');
            echo $this->Form->input('fecha_limite_solucion');
            echo $this->Form->input('co_user_id', ['options' => $coUsers]);
            echo $this->Form->input('solucion');
            echo $this->Form->input('fecha_solucion', ['empty' => true,'templates'=>['select' => '<select name="{{name}}"{{attrs}}>{{content}}</select>','dateWidget' => '<div class="col-md-9">{{year}}{{month}}{{day}}{{hour}}{{minute}}{{second}}{{meridian}}</div>']]);
            echo $this->Form->input('statu_id', ['options' => $status]);
            echo $this->Form->input('notas');
            echo $this->Form->input('created_by', ['options' => $creador]);
        ?>
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">                    
                        <?php echo $this->Form->button(__('<i class="fa fa-check-circle"></i> Guardar'),array('type'=>'submit','class'=>'btn btn-primary','div'=>false,'escape'=>false));?>
                        <?php echo $this->Html->link(__('<i class="fa fa-times-circle"></i> Cancelar'),array('action' => 'index'),array('class'=>'btn  btn-default','escape'=>false,'role'=>'button'));?>
                  </div>
               </div>
             </fieldset>                                                 
             <?= $this->Form->end();?>
             </div>
          </div>               
        </div>
    </div>
</div>