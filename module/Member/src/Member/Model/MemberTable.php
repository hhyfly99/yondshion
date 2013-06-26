<?php
namespace Member\Model;

use Zend\Db\Sql\Ddl\Column\Date;

use Zend\Db\TableGateway\TableGateway;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\AbstractTableGateway;

class MemberTable {
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function getMember($id) {
		$id = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
	
	public function saveMember(Member $member)
	{
		$data = array(
			'memberName' => $member->memberName,
			'memberMail' => $member->memberMail,
			'memberPasswd' => $member->memberPasswd,
			'signupDate' => date('Y-m-d H:i:s'),
		);
		$id = (int)$member->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} 
		else 
		{
			if ($this->getmember($id)) 
			{
				$this->tableGateway->update($data, array('id' => $id));
			} 
			else 
			{
				throw new \Exception('Form id does not exist');
			}
		}
	}
	
}


