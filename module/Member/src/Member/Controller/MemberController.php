<?php
namespace Member\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Debug;
use Member\Model\Member;
use Member\Form\SignInForm;
use Member\Form\SignUpForm;

/*
use ZendService\ReCaptcha\ReCaptcha;
*/

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
	
}