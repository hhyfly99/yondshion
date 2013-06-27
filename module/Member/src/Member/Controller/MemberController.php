<?php
namespace Member\Controller;

use Zend\Crypt\PublicKey\Rsa\PublicKey;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Annotation\AnnotationBuilder;
use Zend\Debug;
use Member\Model\Member;
use Member\Form\SignInForm;
use Member\Form\SignUpForm;

class MemberController extends AbstractActionController {
	/*
	public function index(){
		return array();
	}
	*/
	public function SignInAction() {
		$form = new SignInForm();
        $form->get('submit')->setValue('登录');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $Member = new Member();
            $form->setInputFilter($Member->getSignInInputFilter());
            $form->setData($request->getPost());
            
        	if ($form->isValid()) {
                $Member->exchangeArray($form->getData());
                $this->getMemberTable()->checkMember($Member);

                // Redirect to list of Member
                return $this->redirect()->toRoute('Member');
            }
            
        }
        return array('form' => $form);
	}
	
	public function SignUpAction() {
		$form = new SignUpForm();
		
        $form->get('submit')->setValue('注册');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $Member = new Member();
            $form->setInputFilter($Member->getSignUpInputFilter());
            $form->setData($request->getPost());
            
        	if ($form->isValid()) {
                $Member->exchangeArray($form->getData());
                $this->getMemberTable()->saveMember($Member);

                // Redirect to list of Member
                return $this->redirect()->toRoute('Member');
            }
        }
        return array('form' => $form);
	}
	
	public function getMemberTable()
	{
		if (!$this->MemberTable) {
			$sm = $this->getServiceLocator();
			$this->MemberTable = $sm->get('Member\Model\MemberTable');
		}
		return $this->MemberTable;
	}
	
	public function SignUpFromCheck()
	{
		$form = $this->getFrom();
		$request = $this->getRequest();
		$response = $this->getResponse();
		
		$messages = array();
		if ($request->isPost()){
			$form->getData($request->getPost());
			if (!$form->isValid()){
				foreach ($errors as $key=>$row){
					if (!empty($row) && $key != 'submit'){
						foreach ($row as $keyer=>$rower){
							$messages[$key][] = $rower;
						}
					}
				}
			}
			
			if (!empty($messages)){
				$response->setContent(\Zend\Json\Json::encode($messages));
			}
			else {
				$this->saveMember($form->getData());
				$response->setContent(\Zend\Json\Json::encode(array('success'=>1)));
			}
		}
		
		return $response;
	}
	
	
	public function getFrom(){
		$builder = new AnnotationBuilder();
		$entity = new Member();
		$from = $builder->createFrom($entity);
		
		return $form;
	}
	
	public function SignUpFromValidationAction(){
		$form = new SignUpForm();
		$form->get('submit')->setValue('注册');

        $request = $this->getRequest();
        if ($request->isPost()) {
        	
        }
	}
}