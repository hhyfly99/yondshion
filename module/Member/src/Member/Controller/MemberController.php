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
use Zend\Json\Json;
//use Zend\View\Model\JsonModel;

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
            $member = new Member();
            $form->setInputFilter($member->getSignUpInputFilter());
            $form->setData($request->getPost());
            
        	if ($form->isValid()) {
                $member->exchangeArray($form->getData());
                $this->getMemberTable()->saveMember($member);

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
	
	
	public function getForm(){
		$builder = new AnnotationBuilder();
		$entity = new Member();
		$from = $builder->createFrom($entity);
		
		return $form;
	}
	
	public function saveMemberToDb()
	{
		
	}
	
	public function showformAction()
    {
        $viewmodel = new ViewModel();
        $form       = $this->getForm();
        $request = $this->getRequest();
         
        //disable layout if request by Ajax
        $viewmodel->setTerminal($request->isXmlHttpRequest());
         
        $is_xmlhttprequest = 1;
        if ( ! $request->isXmlHttpRequest()){
            //if NOT using Ajax
            $is_xmlhttprequest = 0;
            if ($request->isPost()){
                $form->setData($request->getPost());
                if ($form->isValid()){
                    //save to db <img src="http://s1.wp.com/wp-includes/images/smilies/icon_wink.gif?m=1129645325g" alt=";)" class="wp-smiley"> 
                    $this->saveMemberToDb($form->getData());
                }
            }
        }
         
        $viewmodel->setVariables(array(
                    'form' => $form,
                    // is_xmlhttprequest is needed for check this form is in modal dialog or not
                    // in view
                    'is_xmlhttprequest' => $is_xmlhttprequest
        ));
         
        return $viewmodel;
    }
    
    
	
	public function SignUpFromValidationAction()
	{
		
		//get from data for validate
		$request = $this->getRequest();
		
		//get form data
		$form = new SignUpForm();
		$member = new Member();
		
		//$member->setData($request->getPost());
		$form->setInputFilter($member->getSignUpInputFilter());
        $form->setData($request->getPost());
		if (! $form->isValid())
		{
			$errors = $form->getMessages();
                foreach($errors as $key=>$row)
                {
                    if (!empty($row) && $key != 'submit') {
                        foreach($row as $keyer => $rower)
                        {
                            //save error(s) per-element that
                            //needed by Javascript
                            $messages[$key][] = $rower;    
                        }
                    }
                }
		}
		return $this->getResponse()->setContent(Json::encode($errors));
		/*
		$data = array(
            'result' => true,
            'data' => array($request)
        );
        return $this->getResponse()->setContent(Json::encode($data));
		*/
	}
}