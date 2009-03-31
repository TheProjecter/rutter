<?php 
class DB_Select
{
	private $sql; //текущий запрос
	private $whereand; 
	
	public function __construct()
	{
		$this->sql="";
		$this->whereand=false;
	}
	
	public function __toString() 
	{
        return $this->sql;
    }
    
    // ВЫБОР ПОЛЕЙ
    
    public function select($cols=null,$distinct=false)
    {
    	$this->sql="SELECT";
    	$this->whereand=false;
    	if ($distinct) $this->sql.=" DISTINCT";
    	switch (true)
    	{
    		case $cols==null:
    			$this->sql.=" *";
    			return $this;
    			
    		case !is_array($cols):
    			$this->sql.=" '".mysql_real_escape_string($cols)."'";
    			return $this;
    			
    		case is_array($cols):
    			$toadd='';
    			foreach ($cols as $key=>$value)
    			{
    				$toadd.=", `".mysql_real_escape_string($value)."`";
    				if (!is_numeric($key)) $toadd.=" AS '".mysql_real_escape_string($key)."'"; 
    			}
    			$this->sql.=substr($toadd,1);
    			return $this;
    	}
    }
    
    // ВЫБОР FROM ТАБЛИЦ
    
    public function from($tables,$as='')
    {
    	switch (true)
    	{
    		case is_array($tables):
    			if ($as!='') $this->sql.=" AS '".$as."'";
    			return $this;
    		
    		case !is_array($tables):
    			$this->sql.=' FROM `'.mysql_real_escape_string($tables).'`';
    			if ($as!='') $this->sql.=" AS '".$as."'";
    			return $this;
    	}
    }
    
    public function where($pattern,$field='')
    {
    	if ($this->whereand) $this->sql.=" AND ("; else { $this->sql.=" WHERE ("; $this->whereand=true; }
    	if ($field==='')
    	{
    		$this->sql.=$pattern.')';
    		return $this;
    	}
    	else
    	{
    		$this->sql.=str_replace('?',"'".mysql_real_escape_string($field),$pattern)."')";
    		return $this;
    	}
    }
    
	public function whereOr($pattern,$field='')
    {
    	$this->sql.=" OR (";
    	if ($field==='')
    	{
    		$this->sql.=$pattern.')';
    		return $this;
    	}
    	else
    	{
    		$this->sql.=str_replace('?',"'".mysql_real_escape_string($field),$pattern)."')";
    		return $this;
    	}
    }
    
    public function order($orders)
    {
    	$this->sql.=' ORDER BY';
    	if (is_array($orders))
    	{
    		$toadd='';
    		foreach ($orders as $value) $toadd.=', '.mysql_real_escape_string($value);
    		$this->sql.=substr($toadd,1);
    		return $this;
    	}
    	$this->sql.=' '.mysql_real_escape_string($orders);
    	return $this;
    }
    
    public function limit($from, $num=0)
    {
    	$this->sql.=" LIMIT ".mysql_real_escape_string($from);
    	if ($num!=0) $this->sql.=', '.mysql_real_escape_string($num);
    	return $this;
    }
    
	public function limitPage($page, $num)
    {
    	$this->sql.=" LIMIT ".$num*($page-1);
    	if ($num!=0) $this->sql.=', '.mysql_real_escape_string($num);
    	return $this;
    }
    
    public function group($group)
    {
    	$this->sql.=' GROUP BY `'.mysql_real_escape_string($group).'`';
    	return $this;
    }
    
}
?>