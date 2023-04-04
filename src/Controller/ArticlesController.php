<?php

    namespace App\Controller;

    use App\Controller\AppController;

    class ArticlesController extends AppController
    {
        public function initialize(): void
        {
            parent::initialize();

            $this->loadComponent('Flash'); // Include the FlashComponent
        }

        public function index()
        {
            $session = $this->request->getSession();
            $email = $session->read('email');
            
            $this->set('articles', $this->Articles->find()->all());
            $this->set(compact('email'));
        }

        public function view($id)
        {
            $article = $this->Articles->get($id);
            $this->set(compact('article'));
        }

        public function add()
        {
            $article = $this->Articles->newEmptyEntity();
            if ($this->request->is('post')) {
            $article->category_id = ($this->request->getData('category_id'));
            $article->title = ($this->request->getData('title'));
            $article->body = ($this->request->getData('body'));

                
                $image = $this->request->getData('filename');
                if($image->getSize()!=null)
                {
                    $name = $image->getClientFilename();
                
                    $article->filename = $image->getClientFilename();
                    $folder = WWW_ROOT . 'img/uploads/users/' . $name;
                    
                    $tmpName = $image->getStream()->getMetadata('uri');
                
                    if(move_uploaded_file($tmpName,$folder))
                    {
                        //pr('image moved to folder');
                    }
    
                    else{
                        //pr('image didnot moved to folder');
                        $this->Flash->error(__('Unable to add image of your article.'));
                    }
                }
               
                // Added: Set the user_id from the session.....Working
                
                $article->email = $this->Auth->user('email');

                
                
                if ($this->Articles->save($article)) {
                    $this->Flash->success(__('Your article has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Unable to add your article.'));
            }
            $this->set('article', $article);

            // Just added the categories list to be able to choose
            // one category for an article
            $categories = $this->Articles->Categories->find('treeList')->all();
            $this->set(compact('categories'));
        }

        public function edit($id = null)
        {
            $article = $this->Articles->get($id);
            if ($this->request->is(['post', 'put'])) {
                    $article->title = ($this->request->getData('title'));
                    $article->body = ($this->request->getData('body'));
        
                    $old_image = $article->filename;
                    $image = $this->request->getData('filename');
                    $name = $image->getClientFilename();
                    $new_filename = $image->getClientFilename();
               

                if($new_filename != '')
                {
                    $tmpName = $image->getStream()->getMetadata('uri');
                    $folder = WWW_ROOT . 'img/uploads/users/' . $name;
                    $tmpName = $image->getStream()->getMetadata('uri');
                    $article->filename = $image->getClientFilename();
                
                
                    if(move_uploaded_file($tmpName,$folder))
                    {
                    // pr('image moved to folder');
                    }

                    else{
                    // pr('image didnot moved to folder');
                        $this->Flash->error(__('Unable to add image of your article.'));
                    }
                }

                else{
                    $article->filename =$old_image;
                }

                if ($this->Articles->save($article)) {
                    $this->Flash->success(__('Your article with title:" {0} "has been updated.',h($article->title)));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('Unable to update your article.'));
            }

            $this->set('article', $article);
        }

        public function delete($id)
        {
            $this->request->allowMethod(['post', 'delete']);

            $article = $this->Articles->get($id);
            
            if ($this->Articles->delete($article)) {
                $this->Flash->success(__('The article with id: {0} has been deleted.', h($id)));
                return $this->redirect(['action' => 'index']);
            }
        }

        public function isAuthorized($user)
            {
            $action = $this->request->getParam('action');
            // The add and tags actions are always allowed to logged in users.
            if (in_array($action, ['add','view'])) {
                return true;
            }
        
            // All other actions require a slug.
            $id = $this->request->getParam('pass.0');
            if (!$id) {
                return false;
            }
        
            // Check that the article belongs to the current user.
            $article = $this->Articles->findById($id)->first();
            return $article->email === $user['email'];
            }

    }
?>
