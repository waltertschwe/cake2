<?php

class PostsController extends AppController {
	
	public $name = 'Posts';
	public $helpers = array('Html', 'Form');
	
	
	// View all Posts
	public function index() {
		$this->set('posts', $this->Post->find('all'));
	}
	
	// View a single post
	public function view($id) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());

    }

    // Add a Post
    public function add() {
        if ($this->request->is('post')) {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
	}
	
	//Edit a Post
	public function edit($id = null) {
    	$this->Post->id = $id;
   	    if ($this->request->is('get')) {
       		$this->request->data = $this->Post->read();
     	} else {
        	if ($this->Post->save($this->request->data)) {
            	$this->Session->setFlash('Your post has been updated.');
            	$this->redirect(array('action' => 'index'));
        	} else {
            	$this->Session->setFlash('Unable to update your post.');
 	        }
        }
	}
	public function delete($id) {
    	if ($this->request->is('get')) {
        	throw new MethodNotAllowedException();
    	}
    	if ($this->Post->delete($id)) {
        	$this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
        	$this->redirect(array('action' => 'index'));
    	}
	}
}
