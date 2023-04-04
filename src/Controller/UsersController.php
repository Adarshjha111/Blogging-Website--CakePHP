<?php

    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\Event\EventInterface;

    class UsersController extends AppController
    {
        public function index()
        {
            $this->set('users', $this->Users->find()->all());
        }

        public function view($id)
        {
            $user = $this->Users->get($id);
            $this->set(compact('user'));
        }

        public function add()
        {
            $user = $this->Users->newEmptyEntity();
            if ($this->request->is('post')) {
                $user = $this->Users->patchEntity($user, $this->request->getData());
            
                if ($this->Users->save($user)) {
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'add']);
                }
                $this->Flash->error(__('Unable to add the user.'));
            }
        
            $this->set('user', $this->Auth->user());

        }

        public function beforeFilter(\Cake\Event\EventInterface $event)
        {
            parent::beforeFilter($event);
            // Configure the login action to not require authentication, preventing
            // the infinite redirect loop issue
            $this->Authentication->addUnauthenticatedActions(['login','add']);
        }

         public function login()
        {
            $this->request->allowMethod(['get', 'post']);
            $result = $this->Authentication->getResult();
            // regardless of POST or GET, redirect if user is logged in
            if ($result->isValid()) {

                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    
                    $u_email = $user['email'];
                    
                    $session = $this->request->getSession();
                    $session->write('email', $u_email);
                }

                // redirect to /articles after login success
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Articles',
                    'action' => 'index',
                ]);

            

                return $this->redirect($redirect);
            }
            // display error if user submitted and authentication failed
            if ($this->request->is('post') && !$result->isValid()) {
                $this->Flash->error(__('Invalid email or password'));
            }
        }

        public function initialize(): void
        {
            parent::initialize();
            $this->Auth->allow(['logout', 'add']);
        }

        public function logout() 
        {
            $session = $this->getRequest()->getSession();
            $this->redirect($this->Auth->logout());
        }
        
    }


?>