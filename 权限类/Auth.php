<?php
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * 版本1.0
 * 权限验证类
 * Enter description here ...
 * @author Administrator
 * 
 *hbl_auth_group_access 表 uid是你自己的用户表的id group_id是用户组的id
 *CREATE TABLE IF NOT EXISTS `hbl_auth_group_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

hbl_auth_group 用户组表   其中 rule是rule表的id 如果多个用逗号给开比如1,2,3,4
CREATE TABLE IF NOT EXISTS `hbl_auth_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `rule` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

hbl_auth_rule 规则表  name是规则比如 Index_index  title是中文名称
CREATE TABLE IF NOT EXISTS `hbl_auth_rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

调用
$this->load->library('auth');
$this->auth->check("Index_index",1);
如果成功返回true 否者返回false
 */
class Auth{
	private $ci;
	public function __construct(){
		
		$this->ci=& get_instance();
	}
	
	/**
	 * $rule规则
	 * $uid用户的id
	 * Enter description here ...
	 * @param unknown_type $rule
	 * @param unknown_type $uid
	 */
	public function check($rule,$uid){
		
		$groupList=$this->getGroupList($uid);
		$authList=$this->getAuthList($groupList);
		$query=$this->ci->db->where(array("name"=>$rule,'status'=>1))->where_in("id",$authList)->get("auth_rule");
		return $query->num_rows()>0 ?true:false;

	}
	
	/**
	 *  获取该用户数组的组
	 * Enter description here ...
	 * @param $uid
	 */
	private function getGroupList($uid){
		
		$query=$this->ci->db->where(array('uid'=>$uid))->select("group_id")->get("auth_group_access");
		$rs=$query->result_array();
		foreach($rs as $key=>$value){
			$str[]=$value["group_id"];
		}
		return implode(",",$str);
		
	}
	
	/**
	 * 获取用户所属组的全部权限id
	 * Enter description here ...
	 * @param unknown_type $groupList
	 */
	private function getAuthList($groupList){
		
		$query=$this->ci->db->where_in("id",$groupList)->select("rule")->get("auth_group");
		$rs=$query->result_array();
		foreach ($rs as $key=>$value){
			$str[]=$value['rule'];
		}
		return implode(",",$str);
		
	}
}