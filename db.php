<?php
class db {

    function db() {
    	include('config.php');
		$db_link=mysql_connect($dbhost,$dbuser,$dbpass);
        mysql_query("SET NAMES 'utf-8'");
        mysql_select_db($dbname);
    }


    function close($db_name) {
    	mysql_close($db_link);
    }

	function query($query) {
		$res = mysql_query($query);
		if(!$res){  $this->error($query); } else {return $res;} ;
		$this->close($db_link);
	}

	function fetch_array($db_res) {
			return @mysql_fetch_array($db_res);
	}

	function num_rows($db_res) {
		return @mysql_num_rows($db_res);
	}

    function result($res,$num,$field) {
    	return @mysql_result($res,$num,$field);
    }

    function get_array($query){
        $array = array();
        $res = $this->query($query);
        $nr = $this->num_rows($res);
        for($i=0;$i<$nr;$i++)
        {$array[$i]=$this->fetch_array($res);}
        return $array;

    }
    function get_row($query){
        $array = array();
        $res = $this->query($query);
        $array = $this->fetch_array($res);
        return $array;

    }
    function get_val($query,$field){
        $array = array();
        $res = $this->query($query);
        $array = $this->fetch_array($res);
        return $array[$field];

    }
    function get_fields($table){
        $array = array();
        $res = $this->query("Show fields from ".$table.";");
        $nr = $this->num_rows($res);
        for($i=0;$i<$nr;$i++)
        {
        $fa=$this->fetch_array($res);
        $array[$i]=$fa['Field'];
        }
        return $array;

    }
    function get_fields_ext($table){
        $array = array();
        $res = $this->query("Show fields from ".$table.";");
        $nr = $this->num_rows($res);
        for($i=0;$i<$nr;$i++)
        {
        $fa=$this->fetch_array($res);
        $array[$i] = array('field'=>$fa['Field'],'type'=>$fa['Type']);
        }
        return $array;

    }
    function insert($table,$data)
    {
        // РїРѕР»СѓС‡Р°РµРј СЃРїРёСЃРѕРє РїРѕР»РµР№ Рё Р·РЅР°С‡РµРЅРёР№ РґР»СЏ Р·Р°РїСЂРѕСЃР° РІСЃС‚Р°РІРєРё
        $fields ='';$values='';
        foreach($this->get_fields($table) as $field)
        { if($field!='id'){ $fields .=$field.','; $values .= "'".$data[$field]."',";} }
        $fields = substr($fields,0,strlen($fields)-1);
        $values = substr($values,0,strlen($values)-1);
		//echo "INSERT INTO ".$table."(".$fields.")  values(".$values.");";
	    $this->query('INSERT INTO '.$table.'('.$fields.')  values('.$values.');');
    }
    function update($table,$data,$id)
    {
         // РїРѕР»СѓС‡Р°РµРј СЃРїРёСЃРѕРє РїРѕР»РµР№ Рё Р·Р°РїРѕР»РЅСЏРµРј РїР°СЂР°РјРµС‚СЂС‹ РѕР±РЅРѕРІР»РµРЅРёСЏ
        $set_str ='';
        foreach($this->get_fields($table) as $field)
        { 
        if($field!='id'){if(array_key_exists($field,$data)){$set_str .=$field." = '".$data[$field]."',";}} 
        }
        $set_str = substr($set_str,0,strlen($set_str)-1);
        //echo $set_str;
        //$ret = 'update '.$table.' set '.$set_str.' where id='.$id;
        $this->query("UPDATE ".$table." SET ".$set_str." WHERE id = ".$id.";");
        //return $ret;
    	    }
    function delete($table,$id)
    {
        $this->query("DELETE from ".$table." WHERE id = '".$id."';");
        //return $ret;
    }
	
	function unipost($arr)
	{
		if (isset($arr["del"])){$this->delete($arr['table'],$arr['id']); }
		if (isset($arr["edit"])){$this->update($arr['table'],$arr,$arr['id']); }
		if (isset($arr["add"])){$this->insert($arr['table'],$arr); }

		
	}
	function error($query) {
		die('<div style="margin:10px;border:1px solid #aaa"><font color="#000000"><b>'.
			mysql_errno().' - '.mysql_error().'<br><br>'.$query.
			'<br><br><small><font color="#ff0000">[DATABASE ERROR STOP]</font></small><br><br></b></font></div>');
	}

};



?>
