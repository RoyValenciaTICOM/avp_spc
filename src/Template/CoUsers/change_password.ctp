  <?php
          
            
                echo $this->Html->css('inspinia/plugins/bootstrap-fileinput/fileinput.min');
            echo $this->Html->script('inspinia/plugins/bootstrap-fileinput/fileinput.min.js'); 
             echo $this->Html->script('inspinia/plugins/bootstrap-fileinput/locales/es.js'); 
               echo $this->Html->script('inspinia/plugins/bootstrap-fileinput/themes/fa/theme.js');
          // echo $this->Html->script('negocios_edit.js');    
        
 ?>
 <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2><?php echo __('Perfil del Usuario');?></h2>                     
    </div>
    <div class="col-lg-2"> </div>
 </div>
 <div class="wrapper wrapper-content animated fadeInRight">     
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5>Imagen de Perfil</h5>                    
               </div>               
            <div class="ibox-content">   
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
             <?= $this->Form->create($user ,['url' => ['action' => 'upload-image'],'type'=>'file']) ?>
                                            <fieldset>                 
                                            <?php
                                                    echo $this->Form->input('upload',['type'=>'file','label'=>['text'=>'Imagen del Perfil'],'required'=>'required'])  ;
                                                  ?>
                                                  <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-9">
                                                        <?php echo $this->Form->button(__('<i class="fa fa-check-circle"></i> Cambiar Imagen'),array('type'=>'submit','class'=>'btn btn-primary','div'=>false,'escape'=>false));?>
                                                        
                                                          <?php   if( !empty($Auth['image'])) echo $this->Html->link(__('<i class="fa fa-trash-o"></i> Eliminar Imagen'),array('action' => 'remove-img'),array('class'=>'btn  btn-danger','escape'=>false,'role'=>'button','confirm' => __('¿Seguro que desea eliminar la imagen de perfil?')));?>
                                                    </div>
                                                  </div>      
                                            </fieldset>
                                            <?php echo $this->Form->end() ;
                                             //echo $this->name.':'.$this->action
                                            ?>
             </div>
          </div>
               
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
          <div class="ibox float-e-margins">
               <div class="ibox-title">
                 <h5>Cambiar contraseña de <?php echo $Auth['nombre']; ?></h5>                    
               </div>               
            <div class="ibox-content">   
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
             <?= $this->Form->create($user) ?>
                                            <fieldset>                 
                                            <?php
                                                   // echo $form->input('id');
                                               
                                                    echo $this->Form->input("old_password", array('label'=>array('class'=>'col-sm-3 control-label','text'=>'Contraseña Anterior'),'size' => 20,'type'=>'password','class'=>'form-control','required'=>true));
                                                    echo $this->Form->input('password1', array('label'=>array('class'=>'col-sm-3 control-label','text'=>'Nueva Contraseña'),'size' =>20,'type'=>'password','class'=>'form-control','required'=>true));
                                                    echo $this->Form->input('password2', array('label'=>array('class'=>'col-sm-3 control-label','text'=>'Confirmar Nueva Contraseña'),'size' =>20,'type'=>'password','class'=>'form-control','required'=>true));
                                                  ?>
                                                  <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-9">
                                                        <?php echo $this->Form->button(__('<i class="fa fa-check-circle"></i> Cambiar Contraseña'),array('type'=>'submit','class'=>'btn btn-primary','div'=>false,'escape'=>false));?>
                                                    </div>
                                                  </div>      
                                            </fieldset>
                                            <?php echo $this->Form->end() ;
                                             //echo $this->name.':'.$this->action
                                            ?>
             </div>
          </div>
               
        </div>
    </div>
</div>

<script type="text/javascript">
       var urlFoto ='';
      $("#upload").fileinput({'showUpload':false, 
                                      'previewFileType':'any',
                                      'theme':'fa',language:
                                       "es",  
                                         allowedFileTypes: ["image"],
                                        maxFileSize: 1000  ,
                                             initialPreview: [
                                              <?php 
                                                if( !empty($user->image)){
                                                    echo "'".$this->request->webroot."upload/avatar/".$user->image."'";
                                                }          
                                              ?>
                                            ],
                                        initialPreviewAsData: true,
                                         overwriteInitial: true    
                                        });

</script>
   