<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;




/**
 * CoUsers Controller
 *
 * @property \App\Model\Table\CoUsersTable $CoUsers
 */
class CoUsersController extends AppController
{

      public $paginate = [
        'limit' => 25,
        'order' => [
            'CoUsers.co_user_id' => 'DESC'
        ]
    ];
      
       public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow([ 'logout']);
    }


    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $conditions = $this->getFiltro(); //Filtro de la consulta
       
        //$this->paginate['contain'] = ['CoGroups','CentrosCapturas']; //Establecemos elcontain y conditions asi cuando usamos un order default
        $this->paginate['conditions'] =$conditions;  //Asignamos el filtro de la consulta
        /*
        //Cuando no se usa un order default entonces el paginate se usa asi
        $this->paginate = [
            'contain' => ['CoGroups'],
            'conditions'=>$conditions
        ];
        */        
        $coUsers = $this->paginate($this->CoUsers);
        
        $coGroups = $this->CoUsers->CoGroups->find('list', ['limit' => 200]);     
        $this->set(compact('coUsers','coGroups'));
        $this->set('_serialize', ['coUsers','coGroups']);
       
    }

    /**
     * Index para administrar usuariios capturistas por municipio
     *
     * @return \Cake\Network\Response|null
     */
    public function indexCentro()
    {
        $conditions = $this->getFiltro(); //Filtro de la consulta
        
        //$conditions= array_merge(['CoUsers.co_group_id'=>4,'CoUsers.centros_captura_id IN' =>$this->Auth->user('centros_captura_id')],$conditions); //Solo capturistas de su municipio      
        
        $this->paginate['conditions'] =$conditions;  //Asignamos el filtro de la consulta
       //  $this->log($this->municipiosUsuario());       
        $coUsers = $this->paginate($this->CoUsers);
        //Tenemos que construir la consulta con matching y luego este query pasarlo al paginate a fin de encontrar los datos en una relacion HasBelongToMany como es el caso de muchos usuarios pertencen a muchos municipios
       /*
       $query = $this->CoUsers->find('all',['contain'=>['CoUsersMunicipios']])
                                    ->matching('CoUsersMunicipios')
                                    ->where($conditions);
        $coUsers = $this->paginate($query);                            
        */
        //$centrosCaptura = $this->CoUsers->CentrosCapturas->get($this->Auth->user('centros_captura_id'));
        $this->set(compact('coUsers'));
        $this->set('_serialize', ['coUsers']);
       
    }

/**
 * Determinamos el alcance del usuario para editar a otros usuarios solo de sus municipios asignados
 * @return [type] [description]
 */
    private function userScope(){
        $municipiosUsuario = $this->municipiosUsuario();

        $queryUsuariosMpios = $this->CoUsers->CoUsersMunicipios->find('list',['conditions'=>['CoUsersMunicipios.municipio_id IN '=>$municipiosUsuario]]);
        return $queryUsuariosMpios;
    }
    

    /**
     * View method
     *
     * @param string|null $id Co User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $coUser = $this->CoUsers->get($id, [
            'contain' => ['CoGroups']
        ]);

        $this->set('coUser', $coUser);
        $this->set('_serialize', ['coUser']);
    }

     public function viewCentro($id = null)
    {
         $coUser = $this->CoUsers->find('all',['conditions'=>['CoUsers.co_user_id'=>$id]])->first();
         

        $this->set('coUser', $coUser);
        $this->set('_serialize', ['coUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $coUser = $this->CoUsers->newEntity();
        if ($this->request->is('post')) {
            $coUser = $this->CoUsers->patchEntity($coUser, $this->request->data);
            if ($this->CoUsers->save($coUser)) {
                $this->Flash->success(__('Usuario agregado correctamente.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El usuario no fue agregado intente de nuevo.'));
            }
        }
        $coGroups = $this->CoUsers->CoGroups->find('list', ['limit' => 200]);
        //$centrosCapturas = $this->CoUsers->CentrosCapturas->find('list', ['order'=>'CentrosCapturas.descripcion','limit' => 200]);        
        $this->set(compact('coUser', 'coGroups'));
        $this->set('_serialize', ['coUser']);
    }

     public function addCentro()
    {
        $coUser = $this->CoUsers->newEntity();
        $centrosCaptura = $this->CoUsers->CentrosCapturas->get($this->Auth->user('centros_captura_id'));  
        if ($this->request->is('post')) {
            $coUser = $this->CoUsers->patchEntity($coUser, $this->request->data);
            $coUser->centros_captura_id = $this->Auth->user('centros_captura_id');
            $coUser->login = $centrosCaptura->iniciales.'_'. $coUser->login;
            $coUser->co_group_id = 4;
            if ($this->CoUsers->save($coUser)) {
                $this->Flash->success(__('Usuario agregado correctamente.'));
                return $this->redirect(['action' => 'index-centro']);
            } else {
                $this->Flash->error(__('El usuario no fue agregado intente de nuevo.'));
            }
        }      
        
        $this->set(compact('coUser', 'coGroups','centrosCaptura'));
        $this->set('_serialize', ['coUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Co User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $coUser = $this->CoUsers->get($id, [
            'contain' => ['CoGroups']
        ]);        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            if(empty($this->request->data['password'])){
                unset($this->request->data['password']);
            }
          //  $this->log($this->request->data);

           // pr($this->request->data);exit;
          $coUser = $this->CoUsers->patchEntity($coUser, $this->request->getData());
           $this->log($coUser);
            if ($this->CoUsers->save($coUser)) {
                $this->Flash->success(__('Usuario editado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El usuario no fue editado.'));
            }
        }
        unset($coUser->password);
     //   pr($coUser['password']);
        $coGroups = $this->CoUsers->CoGroups->find('list', ['limit' => 200]);
         //$centrosCapturas = $this->CoUsers->CentrosCapturas->find('list', ['order'=>'CentrosCapturas.descripcion','limit' => 200]);        
        $this->set(compact('coUser', 'coGroups'));
        $this->set('_serialize', ['coUser']);
    }

     public function editCentro($id = null)
    {
         $coUser = $this->CoUsers->find('all',['contain'=>['CentrosCapturas'],'conditions'=>['CoUsers.co_user_id'=>$id,'CoUsers.centros_captura_id'=>$this->Auth->user('centros_captura_id')]])->first();     

         if(!$coUser){
                   return $this->redirect(['action' => 'index-centro']); 
         }
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            if(empty($this->request->data['password'])){
                unset($this->request->data['password']);
            }
          //  $this->log($this->request->data);

           // pr($this->request->data);exit;
          $coUser = $this->CoUsers->patchEntity($coUser, $this->request->getData());
           $this->log($coUser);
            if ($this->CoUsers->save($coUser)) {
                $this->Flash->success(__('Usuario editado.'));
                return $this->redirect(['action' => 'index-centro']);
            } else {
                $this->Flash->error(__('El usuario no fue editado.'));
            }
        }
        unset($coUser->password);
     //   pr($coUser['password']);
      
        $this->set(compact('coUser', 'coGroups','centrosCapturas'));
        $this->set('_serialize', ['coUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Co User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $coUser = $this->CoUsers->get($id);
        if ($this->CoUsers->delete($coUser)) {
            $this->Flash->success(__('Usuario Eliminado.'));
            $this->AddBitacora("Se elimino al usuario |".json_encode($coUser),$id);
        } else {
            $this->Flash->error(__('El usuario no fue eliminado, intente de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }

     public function deleteCentro($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
         $coUser = $this->CoUsers->find('all',['conditions'=>['CoUsers.co_user_id'=>$id,'CoUsers.centros_captura_id'=>$this->Auth->user('centros_captura_id')]])->first();     

         if(!$coUser){
                   return $this->redirect(['action' => 'index-centro']); 
         }
        if ($this->CoUsers->delete($coUser)) {
            $this->Flash->success(__('Usuario Eliminado.'));
            $this->AddBitacora("Se elimino al usuario |".json_encode($coUser),$id);
        } else {
            $this->Flash->error(__('El usuario no fue eliminado, intente de nuevo.'));
        }
        return $this->redirect(['action' => 'index-centro']);
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
           if(!empty($argumentos['login'])){
               $conditions['CoUsers.login like']=$argumentos['login'].'%'; 
           }
           if(!empty($argumentos['nombre'])){
               $conditions['CoUsers.nombre like']=$argumentos['nombre'].'%'; 
           }
           if(!empty($argumentos['co_group_id'])){
               $conditions['CoUsers.co_group_id']=$argumentos['co_group_id']; 
           }                                
        }   
             
        $this->set(compact('argumentos'));
        return $conditions;
    }
    
    /**
    * Usar FPDF
    * 
    */
    public function usuariosPdf(){         
        
        $query = $this->CoUsers->find("all",['contain'=>['CoGroups']]);
        $usuarios = $query->all();
        $this->set(compact('usuarios'));     
    }
    
    /**
    * Exportar a EXcel
    * 
    */
    public function usuariosExcel(){
         $this->viewBuilder()->layout('excel'); //Establecemos el Layout aqui
        $query = $this->CoUsers->find("all",['contain'=>['CoGroups']]);
        $usuarios = $query->all();
        $this->set(compact('usuarios'));     
    }
    
    
    /**
    * Cambiar la contraseña del usuario, el chiste se hace en el validatorPassword de Model/Table/CoUsersTable.php
    * 
    */
    public function changePassword(){
         $user = $this->CoUsers->get($this->Auth->user('co_user_id'));
         if (!empty($this->request->data)) {
             $user = $this->CoUsers->patchEntity($user, [
                    'old_password' => $this->request->data['old_password'],
                    'password' => $this->request->data['password1'], 
                    'password1' => $this->request->data['password1'],
                    'password2' => $this->request->data['password2']], 
                    ['validate' => 'password']
                    );
             if ($this->CoUsers->save($user)) {
                 $this->Flash->success('Contraseña actualizada con éxito');
                 $this->redirect($this->_getHomePage());//REdireccionamos a la pagina de inicio
             } else {
                 $this->Flash->error('La contraseña no fue actualizada, intente de nuevo');
             }
         }
         $this->set('user', $user);
    }
    
    /**
    * Imagen de Perfil del usuario   , subida por el mismo usuario 
    */
    public function uploadImage(){
        $user = $this->Auth->user();
        $success = false;  
        $data = array('message'=>'Ocurrio un error al procesar la imagen','errors'=>array());  
        $imageFileName = false;    
      //  pr($this->request->data);exit;
      //   if ($this->request->is(['patch', 'post', 'put'])) {
             //Se envia como form-data normal en lugar de application/x-www-form-urlencoded
             if (!empty($this->request->data)) {
                 
                if (!empty($this->request->data['upload']['name'])) {
                $file = $this->request->data['upload']; //put the data into a var for easy use

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif','png'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);

                //only process if the extension is valid
                if (in_array($ext, $arr_ext)) {
                    //do the actual uploading of the file. First arg is the tmp name, second arg is 
                    //where we are putting it
                    move_uploaded_file($file['tmp_name'], WWW_ROOT . DS.'upload'.DS.'avatar'.DS . $setNewFileName . '.' . $ext);

                    //prepare the filename for database entry 
                    $imageFileName = $setNewFileName . '.' . $ext;
                    if($imageFileName){ //Guardamos la imagen en la BD
                        $user = $this->Auth->user();
                        $id = $user['co_user_id'];
                        $coUser = $this->CoUsers->get($id, [
                            'contain' => []
                        ]);                        
                        //Borramos la imagen anterior si existe
                            if($coUser->image){
                                @unlink( WWW_ROOT . DS.'upload'.DS.'avatar'.DS .$coUser->image);
                            }
                        //Actualizamos la imagen de perfil en la BD                    
                         $coUser->image = $imageFileName;
                        if ($this->CoUsers->save($coUser)) {
                          $success =true;
                           $this->Auth->setUser($coUser->toArray());
                          $this->Flash->success('Imagen de Perfil actualizada con éxito');
                       } else {
                          $success =false;
                          $this->Flash->error('La imagen de perfil no fue actualizada, intente de nuevo');
                       }                  
                      
                    }
                }else{
                        $success =false;
                       $this->Flash->error('Extensión de archivo no válida');
                        $data['errors'] = array();
                }
              }      
           }else{
               $this->Flash->error('No hay imagen para subir');
           }
       //  }
         $this->redirect(['action'=>'change-password']);
         $this->set(compact('data','success'));
        $this->set('_serialize', ['success','data']);
    }
    
    /**
    * Quitar imagen de perfil
    * 
    */
    public function removeImg(){
         $user = $this->Auth->user();
         if($user['image']){            
              
               $id = $user['co_user_id'];
               $coUser = $this->CoUsers->get($id, [
                            'contain' => []
                ]);
                $coUser->image = null;
                 if ($this->CoUsers->save($coUser)) {
                          @unlink( WWW_ROOT . DS.'upload'.DS.'avatar'.DS .$user['image']);  
                          $success =true;
                           $this->Auth->setUser($coUser->toArray());
                          $this->Flash->success('Imagen de Perfil eliminada con éxito');
                 } else {
                          $success =false;
                          $this->Flash->error('La imagen de perfil no fue eliminada, intente de nuevo');
                 }  
                 
                
         }
          $this->redirect(['action'=>'change-password']);
        
    }
    
    //FUNCIONES DE INICIO Y CIERRE DE SESION DEL USUIARIO
    
     /**
     * Login a la aplicacion
     * 
     */
      public function login()
    {
          $this->viewBuilder()->layout('login');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();//Verificacion de usuario valido
            if ($user) {
                $this->Auth->setUser($user);
                $query = $this->CoUsers->query();
                $query->update()
                    ->set(['last_login'=> date('Y-m-d H:i:s')])
                    ->where(['co_user_id' => $this->Auth->user('co_user_id')])
                    ->execute();
                
                return $this->redirect($this->_getHomePage());
            }
            $this->Flash->errorlogin(__('Nombre de usuario o contraseña incorrecta.'));
        }
    }
    
      /**
    * Obtener el Home page del usuario
    * 
    */
  private  function _getHomePage(){
        $group_id = $this->Auth->user('co_group_id');
        //buscamos en el grupo los datos del home page
        $grupo=  $this->CoUsers->CoGroups->find('all',['conditions'=>['CoGroups.co_group_id'=>$group_id]])->first();;    
        if(strlen($grupo->home_page)>0){
            $url=$grupo->home_page;            
        }else{  //Si no tiene pagina de inicio(home Page) default lo desviamos al home principal
          $url = $this->Auth->redirectUrl();           
        }
        return $url;
    }

    /**
    * Cerrar Sesion
    * 
    */
    public function logout()   
    {
         $this->request->session()->destroy();//Destruimos la sesions por aquello del os permisos
        return $this->redirect($this->Auth->logout());
    }
}
