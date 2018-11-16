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

        $user = $this->Auth->User('co_user_id');
        $grupo = $this->Auth->User('co_group_id');

        if ($grupo==3){

        $this->paginate = [
            'contain' => ['TipoServicios'=>['Grupos'], 'TipoIncidencias', 'Prioridades', 'CatAdscripciones', 'CoUsers', 'Status'],'order'=>['servicio_id DESC'],'conditions'=>['Servicios.co_user_id'=>$user]
        ];
        $servicios = $this->paginate($this->Servicios);
        }else{
             $this->paginate = [
            'contain' => ['TipoServicios'=>['Grupos'], 'TipoIncidencias', 'Prioridades', 'CatAdscripciones', 'CoUsers', 'Status'],'order'=>['servicio_id DESC']
        ];
        $servicios = $this->paginate($this->Servicios);
        }

        $this->set(compact('servicios'));
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
            'contain' => ['TipoServicios', 'TipoIncidencias', 'Prioridades', 'CatAdscripciones', 'CoUsers', 'Status','creador']
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

            

            
            if ($this->Servicios->save($servicio)) {
                $this->Flash->success(__('El Servicio ha sido guardado.'));
                return $this->redirect(['action' => 'index']);


                /*if ($this->$servicio->terminar==0){ 
                    //return $this->redirect(['action' => 'index']);
                }
                 if ($this->$servicio->terminar==1){ 
                    return $this->redirect(['action' => 'editsolucion']);
                }*/
            }
                $this->Flash->error(__('The servicio could not be saved. Please, try again.'));
            }
            
            
        
        $tipoServicios = $this->Servicios->TipoServicios->find('list', ['limit' => 200,
    'order' => ['grupo_id' => 'ASC','descripcion'=>'ASC']
]);
        $tipoIncidencias = $this->Servicios->TipoIncidencias->find('list', ['limit' => 200]);
        $prioridades = $this->Servicios->Prioridades->find('list', ['limit' => 200]);
        $catAdscripciones = $this->Servicios->CatAdscripciones->find('list', array('order'=>array('nom_ads'=>'ASC')));
        $coUsers = $this->Servicios->CoUsers->find('list',array('conditions'=>array('co_group_id <>'=>1)));
        $status = $this->Servicios->Status->find('list', ['limit' => 200]);

        //$user=$this->Session->read('CoUser.co_user_id');
        $user = $this->Auth->User('co_user_id');

        $this->set(compact('servicio', 'tipoServicios', 'tipoIncidencias', 'prioridades', 'catAdscripciones', 'coUsers', 'status','user'));
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
        $servicio = $this->Servicios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servicio = $this->Servicios->patchEntity($servicio, $this->request->getData());
            if ($this->Servicios->save($servicio)) {
                $this->Flash->success(__('The servicio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The servicio could not be saved. Please, try again.'));
        }
        $tipoServicios = $this->Servicios->TipoServicios->find('list', ['limit' => 200]);
        $tipoIncidencias = $this->Servicios->TipoIncidencias->find('list', ['limit' => 200]);
        $prioridades = $this->Servicios->Prioridades->find('list', ['limit' => 200]);
        $catAdscripciones = $this->Servicios->CatAdscripciones->find('list', ['limit' => 200]);
        $coUsers = $this->Servicios->CoUsers->find('list', ['limit' => 200]);
        $status = $this->Servicios->Status->find('list', ['limit' => 200]);
       
        $this->set(compact('servicio', 'tipoServicios', 'tipoIncidencias', 'prioridades', 'catAdscripciones', 'coUsers', 'status'));
    }

    public function editsolucion($id = null)
    {
        $servicio = $this->Servicios->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servicio = $this->Servicios->patchEntity($servicio, $this->request->getData());
            if ($this->Servicios->save($servicio)) {
                $this->Flash->success(__('The servicio has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The servicio could not be saved. Please, try again.'));
        }
        $tipoServicios = $this->Servicios->TipoServicios->find('list', ['limit' => 200]);
        $tipoIncidencias = $this->Servicios->TipoIncidencias->find('list', ['limit' => 200]);
        $prioridades = $this->Servicios->Prioridades->find('list', ['limit' => 200]);
        $catAdscripciones = $this->Servicios->CatAdscripciones->find('list', ['limit' => 200]);
        $coUsers = $this->Servicios->CoUsers->find('list', ['limit' => 200]);
        $status = $this->Servicios->Status->find('list', ['limit' => 200]);
       
        $this->set(compact('servicio', 'tipoServicios', 'tipoIncidencias', 'prioridades', 'catAdscripciones', 'coUsers', 'status'));
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
}
