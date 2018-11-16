<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Servicios Controller
 *
 * @property \App\Model\Table\ServiciosTable $Servicios
 *
 * @method \App\Model\Entity\Servicio[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServiciosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */


    public function index()
    {

        $conditions = $this->getFiltro(); //Filtro de la consulta

        $user = $this->Auth->User('co_user_id');
        $grupo = $this->Auth->User('co_group_id');

        if ($grupo==3){

        $conditions['Servicios.co_user_id']=$user;
        $this->paginate = [
            'contain' => ['TipoServicios'=>['Grupos'], 'TipoIncidencias', 'Prioridades', 'CatAdscripciones', 'CoUsers', 'Status'],'order'=>['servicio_id DESC'],'conditions'=>$conditions
        ];
        $servicios = $this->paginate($this->Servicios);
        }else{
             $this->paginate = [
            'contain' => ['TipoServicios'=>['Grupos'], 'TipoIncidencias', 'Prioridades', 'CatAdscripciones', 'CoUsers', 'Status'],'order'=>['servicio_id DESC'],'conditions'=>$conditions
        ];
        $servicios = $this->paginate($this->Servicios);
        }

        
        $catAdscripciones = $this->Servicios->CatAdscripciones->find('list');
        $status = $this->Servicios->Status->find('list');
         $tipoServicios = $this->Servicios->TipoServicios->find('list', ['groupField' => 'grupo.descripcion' , 'contain' => ['Grupos'],
    'order' => ['Grupos.descripcion' => 'ASC','TipoServicios.descripcion'=>'ASC']
]);

        $this->set(compact('servicios','grupo','catAdscripciones','status','tipoServicios'));
    }

    /**
     * View method
     *
     * @param string|null $id Servicio id. 
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        
        
        $servicio = $this->Servicios->get($id, [
            'contain' => ['TipoServicios', 'TipoIncidencias', 'Prioridades', 'CatAdscripciones', 'CoUsers', 'Status','creador','Bitacoraservs','Adjuntos']
        ]);

        
       //$usuario=$servicio->created_by;
        //$query = $this->Servicios->CoUsers->find('all',array('conditions'=>array('co_user_id'=>$usuario),'fields'=>'nombre'));
        //$nombreU = $query->first()->nombre;
        //$this->set(compact('servicio','nombreU'));

       

        $this->set(compact('servicio'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $servicio = $this->Servicios->newEntity();
        if ($this->request->is('post')) {

            $servicio = $this->Servicios->patchEntity($servicio, $this->request->getData());
            $servicios2=$this->request->getData();
            $servicios3=$servicios2['terminar'];
            
            if ($this->Servicios->save($servicio)) {
                $this->Flash->success(__('El Servicio fue Guardado con Éxito.'));

                if($servicios3==1){
                    return $this->redirect(['action' => 'editsolucion',$servicio->servicio_id,3]);
                }else{
                    return $this->redirect(['action' => 'index']);
                }
                
            }
            $this->Flash->error(__('El Servicio NO fue Guardado, por favor intente de nuevo.'));
        }
        /*$tipoServicios = $this->Servicios->TipoServicios->find('list', ['limit' => 200,
    'order' => ['grupo_id' => 'ASC','descripcion'=>'ASC']
]);*/
         $tipoServicios = $this->Servicios->TipoServicios->find('list', ['groupField' => 'grupo.descripcion' , 'contain' => ['Grupos'],
    'order' => ['Grupos.descripcion' => 'ASC','TipoServicios.descripcion'=>'ASC']
]);
        $tipoIncidencias = $this->Servicios->TipoIncidencias->find('list', ['limit' => 200]);
        $prioridades = $this->Servicios->Prioridades->find('list', ['limit' => 200]);
        $catInstituciones = $this->Servicios->CatInstituciones->find('list', array('order'=>array('nombre'=>'ASC')));
        //$catAdscripciones = $this->Servicios->CatAdscripciones->find('list', array('order'=>array('nom_ads'=>'ASC')));
        $coUsers = $this->Servicios->CoUsers->find('list',array('conditions'=>array('co_group_id <>'=>1),'order'=>array('nombre'=>'ASC')));
        $status = $this->Servicios->Status->find('list', ['limit' => 200]);

        //$user=$this->Session->read('CoUser.co_user_id');
        $user = $this->Auth->User('co_user_id');

        $this->set(compact('servicio', 'tipoServicios', 'tipoIncidencias', 'prioridades','catInstituciones', 'coUsers', 'status','user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Servicio id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Bitacoraservs');
        $bitacoraserv = $this->Bitacoraservs->newEntity();

        $servicio = $this->Servicios->get($id, [
            'contain' => []
        ]);
        $Recibido=$this->request->getData();
        $UsuarioAnterior=$servicio->co_user_id;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servicio = $this->Servicios->patchEntity($servicio, $this->request->getData());
            $bitacoraserv = $this->Bitacoraservs->patchEntity($bitacoraserv, $Recibido['bitacoraserv']);

            $servicios2=$this->request->getData();
            $UsuarioNuevo=$servicios2['co_user_id'];

            if ($this->Servicios->save($servicio)) {

                if ($UsuarioAnterior!=$UsuarioNuevo){

                    $coUsers2 = $this->Servicios->CoUsers->find('list', ['conditions' => ['co_user_id'=>$UsuarioAnterior]]);
                    $UsuarioAnteriorD=$coUsers2->first();

                    $bitacoraserv['descripcion_evento']="Usuario Responsable anterior: ".$UsuarioAnteriorD;
                    $this->Bitacoraservs->save($bitacoraserv);
                }

                $this->Flash->success(__('El Servicio fue Guardado con Éxito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El Servicio NO fue Guardado, por favor intente de nuevo.'));
        }
         $tipoServicios = $this->Servicios->TipoServicios->find('list', ['groupField' => 'grupo.descripcion' , 'contain' => ['Grupos'],
    'order' => ['Grupos.descripcion' => 'ASC','TipoServicios.descripcion'=>'ASC']
]);
        $tipoIncidencias = $this->Servicios->TipoIncidencias->find('list', ['limit' => 200]);
        $prioridades = $this->Servicios->Prioridades->find('list', ['limit' => 200]);
        $catInstituciones = $this->Servicios->CatInstituciones->find('list', array('order'=>array('nombre'=>'ASC')));
        $catAdscripciones = $this->Servicios->CatAdscripciones->find('list',['conditions' => ['cat_institucione_id'=>$servicio['cat_institucione_id']]]);
        //$coUsers = $this->Servicios->CoUsers->find('list', ['limit' => 200]);
         $coUsers = $this->Servicios->CoUsers->find('list',array('conditions'=>array('co_group_id <>'=>1),'order'=>array('nombre'=>'ASC')));
        $status = $this->Servicios->Status->find('list', ['limit' => 200]);
       
        $this->set(compact('servicio', 'tipoServicios', 'tipoIncidencias', 'prioridades','catInstituciones','catAdscripciones','coUsers', 'status','UsuarioAnterior'));
    }

/**
     * Edit method
     *
     * @param string|null $id Servicio id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
 public function editsolucion($id = null, $estado = null)
    {
        $this->loadModel('Bitacoraservs');
        $bitacoraserv = $this->Bitacoraservs->newEntity();
      
        $servicio = $this->Servicios->get($id, [
            'contain' => []
        ]);
         $Recibido=$this->request->getData();
         //pr($Recibido['bitacoraserv']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            /*$servicio = $this->Servicios->patchEntity($servicio, $this->request->getData(),[
    'associated' => [ 'Bitacoraservs']
]);*/
$servicio = $this->Servicios->patchEntity($servicio, $this->request->getData());
$bitacoraserv = $this->Bitacoraservs->patchEntity($bitacoraserv, $Recibido['bitacoraserv']);
//pr($servicio);
            //if ($this->Servicios->save($servicio)) {
            if ($this->Servicios->save($servicio) AND $this->Bitacoraservs->save($bitacoraserv)) {
                $this->Flash->success(__('The servicio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
          $andTheErrorsAre = $servicio->getErrors();
            $this->Flash->error(__('The servicio could not be saved. Please, try again.'));
        }
        $tipoServicios = $this->Servicios->TipoServicios->find('list', ['limit' => 200]);
        $tipoIncidencias = $this->Servicios->TipoIncidencias->find('list', ['limit' => 200]);
        $prioridades = $this->Servicios->Prioridades->find('list', ['limit' => 200]);
        $catInstituciones = $this->Servicios->CatInstituciones->find('list', ['limit' => 200]);
        $catAdscripciones = $this->Servicios->CatAdscripciones->find('list', ['limit' => 200]);
        //$coUsers = $this->Servicios->CoUsers->find('list', ['limit' => 200]);
         $coUsers = $this->Servicios->CoUsers->find('list',array('conditions'=>array('co_group_id <>'=>1),'order'=>array('nombre'=>'ASC')));
        $status = $this->Servicios->Status->find('list', ['limit' => 200]);

        $user = $this->Auth->User('co_user_id');
        $coUsers2 = $this->Servicios->CoUsers->find('list', ['conditions' => ['co_user_id'=>$user]]);
        $user2=$coUsers2->first();

        
       
        $this->set(compact('servicio', 'tipoServicios', 'tipoIncidencias', 'prioridades','CatInstituciones', 'catAdscripciones', 'coUsers', 'status','estado','user2'));
    }
   

    /**
     * Delete method
     *
     * @param string|null $id Servicio id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $servicio = $this->Servicios->get($id);
        if ($this->Servicios->delete($servicio)) {
            $this->Flash->success(__('The servicio has been deleted.'));
        } else {
            $this->Flash->error(__('The servicio could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
    * Buscar
    * 
    * @param mixed $borrarFiltro si se pasa 1 se borra el filtro de la sesion
    */
     public function buscar($borrarFiltro = 0)
    {
       $session = $this->request->session(); //Manejo de sesiones en la version 3
        if ($this->request->is('post')) {
        if(!empty($this->request->data)) 
        {
            $url = [];
            $url['action']=(isset($this->request->data['destino'])) ? $this->request->data['destino'] : 'index';
            foreach ($this->request->data as $k=>$v)
            {
               $url[$k] =$v;               
            }
            $argumentos= $url;
            
            $session->write('argumentos'.$this->name,$argumentos);
            $this->redirect($url, null, true);
        }
       }
        if($borrarFiltro==1) //Borrado del filtro de busqueda
        { 
           $session->delete('argumentos'.$this->name);   
            if ($this->referer() != '/') 
            {
                $this->redirect($this->referer());
            } 
            else 
            {
                $this->redirect(array('action' => 'index'));
            }
        }
             
    }
   
   /**
   * Filtro del paginate
   *  
   */
    public function getFiltro(){
        $session = $this->request->session(); //Manejo de sesiones en la version 3
        $argumentos = null;
        $conditions =[];
        if($session->check('argumentos'.$this->name)){
            $argumentos = $session->read('argumentos'.$this->name);          
            $this->request->data = $argumentos;    //Para los datos en el view
           if(!empty($argumentos['descripcion_corta'])){
               $conditions['Servicios.descripcion_corta like']=$argumentos['descripcion_corta'].'%'; 
           }
           if(!empty($argumentos['cat_adscripcione_id'])){
               $conditions['Servicios.cat_adscripcione_id']=$argumentos['cat_adscripcione_id']; 
           }
           if(!empty($argumentos['statu_id'])){
               $conditions['Servicios.statu_id']=$argumentos['statu_id']; 
           } 
           if(!empty($argumentos['tipo_servicio_id'])){
               $conditions['Servicios.tipo_servicio_id']=$argumentos['tipo_servicio_id']; 
           }
            if(!empty($argumentos['folio'])){
               $conditions['Servicios.servicio_id like']=$argumentos['folio'].'%'; 
           }                                 
        }   
             
        $this->set(compact('argumentos'));
        return $conditions;
    }
    
   /**
    * Exportar a EXcel
    * 
    */
    public function serviciosExcel(){
        

        $filtro = $this->getFiltro();

        $user = $this->Auth->User('co_user_id');
        $grupo = $this->Auth->User('co_group_id');

        

         $this->viewBuilder()->layout('excel'); //Establecemos el Layout aqui
        //$query = $this->Servicios->find("all",['contain'=>['TipoServicios','CatAdscripciones','CoUsers','Status']]);

         if ($grupo==3){
             $filtro['Servicios.co_user_id']=$user;
            $query = $this->Servicios->find("all",['contain'=>['TipoServicios'=>['Grupos'],'CatAdscripciones','CoUsers','Status'],'conditions'=>$filtro]);
        }else{
            $query = $this->Servicios->find("all",['contain'=>['TipoServicios'=>['Grupos'],'CatAdscripciones','CoUsers','Status'],'conditions'=>$filtro]);
        }
         //echo $query;
         //var_dump(query);
         
        $servicios = $query->all();
        $this->set(compact('servicios'));
               
    }

    public function download($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Descarga Invalida', true));
            $this->redirect(array('action'=>'index'));
            
        }
        //if (!empty($this->data)) {
            //$filename = $this->Adjuntos->findByAdjuntoId($id);

        $this->loadModel('Adjuntos');
        

            //$filename=$this->Adjuntos->find('list',array('conditions'=>array('adjunto_id'=>$id)));
            $fila = $this->Adjuntos->findByAdjuntoId($id);
            $filename=$fila->first();
            
            //pr($filename['archivo']);
           


            
             $name=$filename['archivo'];
            $path = empty($path) ? WWW_ROOT.'/upload/archivos/' : $path;
            $file="$path/".$name;
            //$mimeType = $this->mimeType($file);

            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
           // header("Content-Type: ".$mimeType);
            header("Content-type: application/force-download");
            header("Content-Length: ".@filesize($file));
            header("Content-Disposition: Adjuntos; filename=\"".$name."\";");
             $fp = fopen($file, "r"); 
           fpassthru($fp); 
           fclose($fp);
         //   set_time_limit(0);
           // @readfile("$file");   //Reemplazamos la funcion por compatibilidades con el server de produccion 
            exit;
            $this->Session->setFlash(__('El archivo ha sido descargado', true));
            $this->redirect(array('action'=>'index'));

     
        if (empty($this->data)) {
         //  $this->data = $this->ArcAdjunto->read(null, $id);
        }   
    }

 public function ajaxproceso(){ 
       

        $this->request->allowMethod('ajax');
   
        $institucion = $this->request->query('institucion');

        $query = $this->Servicios->CatAdscripciones->find('all',array('fields' => array ('cat_adscripcione_id','nom_ads') ,'conditions' => array('cat_institucione_id'=>$institucion)));

       

        $this->set('adscripciones', $query);
        $this->set('_serialize', ['adscripciones']);

 }
 
 public function dictamen($id = null)
    {                
        $servicio = $this->Servicios->get($id, [
            'contain' => ['TipoServicios', 'TipoIncidencias', 'Prioridades', 'CatAdscripciones', 'CoUsers', 'Status','creador']
        ]);     
        
        $this->viewBuilder()->options([
                'pdfConfig' => [
                    'orientation' => 'portrait'
                    //'filename' => 'Invoice_' . $id
                ]
            ]);
            
             
        $this->set(compact('servicio'));
    }
    
    public function reporte($id = null)
    {                
        $servicio = $this->Servicios->get($id, [
            'contain' => ['TipoServicios', 'TipoIncidencias', 'Prioridades', 'CatAdscripciones', 'CoUsers', 'Status','creador']
        ]);  
        
        $this->viewBuilder()->options([
                'pdfConfig' => [
                    'orientation' => 'portrait'
                    //'filename' => 'Invoice_' . $id
                ]
            ]);
                
        $this->set(compact('servicio'));
    }


}
