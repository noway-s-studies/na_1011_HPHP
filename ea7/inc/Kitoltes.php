<?php

class Kitoltes {
    
    public $kid;
    public $tid;
        
    public function KitoltesValaszInsert($tkid, $tvid) {
        global $db;
        $stmt = $db->prepare("delete from kitoltesvalaszok where kid = ? and tkid = ?");
        $stmt->execute(array($this->kid,$tkid));
        
        $stmt = $db->prepare("insert into kitoltesvalaszok (kid, tkid, tvid) values (?,?,?)");
        $stmt->execute(array($this->kid,$tkid,$tvid));
    }
    
    public function KitoltesValaszChecked($tkid, $tvid) {
        global $db;
        $stmt = $db->prepare("select count(*) from kitoltesvalaszok where kid = ? and tkid = ? and tvid = ?");
        $stmt->execute(array($this->kid,$tkid,$tvid));
        $res = $stmt->fetch();
        return $res[0]>0;
    }
    
    public function KitoltesValaszVanE($tkid) {
        global $db;
        $stmt = $db->prepare("select count(*) from kitoltesvalaszok where kid = ? and tkid = ?");
        $stmt->execute(array($this->kid,$tkid));
        $res = $stmt->fetch();
        return $res[0]>0;
    }
    
}

