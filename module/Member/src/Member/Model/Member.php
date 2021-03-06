<?php
namespace Member\Model;

use Zend\Validator\StringLength;
use Zend\Form\Annotation;
use Zend\Validator\Regex;
use Zend\Validator\NotEmpty;
use Zend\Validator\EmailAddress;
use Zend\Validator\Identical;
use Zend\Validator\Digits;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Member {
	
	protected $id;
	protected $memberName;
	protected $memberMail;
	protected $memberPasswd;
	protected $memberPasswdComfirm;
	protected $memberSalt;
	public $recaptcha;
	public $signInInputFilter;
	public $signUpInputFilter;
	
	public function exchangeArray($data) {
		$this->id = (isset($data['id'])) ? $data['id'] : null;
		$this->memberName = (isset($data['memberName'])) ? $data['memberName'] : null;
		$this->memberMail = (isset($data['memberMail'])) ? $data['memberMail'] : null;
		$this->memberPasswd = (isset($data['memberPasswd'])) ? $data['memberPasswd'] : null;
		$this->memberPasswdComfirm = (isset($data['memberPasswd'])) ? $data['memberPasswd'] : null;
		$this->memberPasswd = (isset($data['memberPasswd'])) ? $data['memberPasswd'] : null;
		$this->recaptcha = (isset($data['recaptcha'])) ? $data['recaptcha'] : null;
	}
	
	public function getSignInInputFilter() {
		if (!$this->signInInputFilter) {
            $signInInputFilter = new InputFilter();
            $factory     = new InputFactory();

            $signInInputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $signInInputFilter->add($factory->createInput(array(
                'name'     => 'memberName',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));

            $signInInputFilter->add($factory->createInput(array(
                'name'     => '',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
            
            $signInInputFilter->add($factory->createInput(array(
                'name'     => 'memberPasswd',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
            
            $signInInputFilter->add($factory->createInput(array(
                'name'     => 'recaptchaInput',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 20,
                        ),
                    ),
                ),
            )));

            $this->signInInputFilter = $signInInputFilter;
        }

        return $this->signInInputFilter;
	}
	
	public function getSignUpInputFilter() {
		if (!$this->signUpInputFilter) {
            $signUpInputFilter = new InputFilter();
            $factory     = new InputFactory();
			
            $signUpInputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
			
            $signUpInputFilter->add($factory->createInput(array(
                'name'     => 'memberName',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array(
                    		'messages' => array(
                    			NotEmpty::IS_EMPTY => '会员名必须输入',
                    		),
                        ),
                        'break_chain_on_failure' => true
                    ),
                	array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 100,
                    		'messages' => array(
                    			StringLength::TOO_SHORT => '会员名不少于6个字符',
                    			StringLength::TOO_LONG => '会员名不大于100个字符',
                    		),
                        ),
                        'break_chain_on_failure' => true,
                    ),
                ),
            )));

            $signUpInputFilter->add($factory->createInput(array(
                'name'     => 'memberMail',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array(
                    		'messages' => array(
                    			NotEmpty::IS_EMPTY => '邮箱地址必须输入',
                    		),
                        ),
                        'break_chain_on_failure' => true,
                    ),
                	array(
                        'name'    => 'EmailAddress',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 100,
                    		'messages' => array(
                    			EmailAddress::INVALID_FORMAT => '邮箱地址不正确',
                    		),
                        ),
                        'break_chain_on_failure' => true,
                    ),
                ),
            )));
            
            $signUpInputFilter->add($factory->createInput(array(
                'name'     => 'memberPasswd',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array(
                    		'messages' => array(
                    			NotEmpty::IS_EMPTY => '密码必须输入',
                    		),
                        ),
                        'break_chain_on_failure' => true,
                    ),
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 100,
                    		'messages' => array(
                    			StringLength::TOO_SHORT => '密码不少于6个字符',
                    			StringLength::TOO_LONG => '密码不大于100个字符',
                    		),
                        ),
                        'break_chain_on_failure' => true,
                    ),
                    array(
                    	'name' => 'Regex', 
                    	'options' => array(
                    		'messages' => array(
                    			'regexNotMatch' => '密码必须包含字母数字',
                    		),
                    		//'pattern' => '/^([a-zA-Z0-9]*[a-zA-Z][a-zA-Z0-9]*)$/',
                    		//'pattern' => '/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/',
                    		'pattern' => '/^(?=.*\d)(?=.*[a-zA-Z]).{6,16}$/',
                    	),
                    	'break_chain_on_failure' => true,
                    ),
                ),
            )));
            
            $signUpInputFilter->add($factory->createInput(array(
                'name'     => 'memberPasswdComfirm',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array(
                    		'messages' => array(
                    			NotEmpty::IS_EMPTY => '再输一次密码',
                    		),
                        ),
                        'break_chain_on_failure' => true,
                    ),
                    array(
                    	'name' => 'Identical',
                    	'options' => array(
                    		'token' => 'memberPasswd',
                    		'messages' => array(
                    			Identical::NOT_SAME => '两次密码输入不一致',
                    		),
                    	),
                    	'break_chain_on_failure' => true,
                    ),
                ),
            )));
            
            $signUpInputFilter->add($factory->createInput(array(
                'name'     => 'captcha',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'NotEmpty',
                        'options' => array(
                    		'messages' => array(
                    			NotEmpty::IS_EMPTY => '验证码必须输入',
                    		),
                        ),
                    ),
                	array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 5,
                            'max'      => 5,
                        ),
                    ),
                ),
            )));
            
            $signUpInputFilter->add($factory->createInput(array(
                'name'     => 'agreement',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                	array(
                        'name' => 'Digits', 
                        'options' => array(
                        	'messages' => array(
                            	Digits::NOT_DIGITS => '同意协议才能注册',
                             ),
                    	),
                    	'break_chain_on_failure' => true,
                    ),
                ),
            )));

            $this->signUpInputFilter = $signUpInputFilter;
        }

        return $this->signUpInputFilter;
	}
}