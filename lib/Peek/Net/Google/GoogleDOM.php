<?php

namespace Peek\Net\Google;
/**
 * Description of GoogleDOM
 *
 * @author sghzal
 */
class GoogleDOM extends \DOMDocument{
    
    /**
     * list of natural nodes
     */
    const NATURAL_QUERY="//div[@id = 'ires']/ol/li[@class='g'][not(@id) or @id != 'imagebox_bigimages']";
    
    /**
     * Get natural link (<a> tag) in the natural node context
     */
    const NATURAL_LINKS_IN="descendant::h3[@class='r'][1]/a"; 
    
    protected $naturalsResults;
    protected $xpath;


    public function __construct($version = null, $encoding = null) {
        parent::__construct($version, $encoding);
        
        $this->init();
    }
    
    public function init(){
        $this->naturalsResults=null;
    }
    
    /**
     * get the object xpath to query it
     * @return \DOMXPath
     */
    public function getXpath() {
        if(null === $this->xpath){
            $this->xpath=new \DOMXPath($this);
        }
        return $this->xpath;
    }

        
    /**
     * gives the list of the natural results
     * @return \DOMNodeList list of naturals results
     */
    public function getNaturals() {
        
        if(null === $this->naturalsResults){
        
            $query=self::NATURAL_QUERY;

            
            $this->naturalsResults=$this->getXpath()->query($query);
            
        }
        
        return $this->naturalsResults;
    }
    
    /**
     * search in the google results to find the given website
     * @param $site the searched website.  It is recommended to only give the domain+tld (exemple : "google.com") without the "www" or protocole. 
     * Obviously if you search for a subdomain specify it (e.g "translate.google.com")
     * @return int|bool the position of the site into the page, or false if not found. Position begins to 1
     */
    public function searchWebSite($site){
        
        $number=1;
        
        $naturals=$this->getNaturals();
        

        
        $query=self::NATURAL_LINKS_IN;
        
        foreach($naturals as $node){
            
            
            
            $aTag=$this->naturalsResults=$this->getXpath()->query($query,$node);
            $aTag=$aTag->item(0);
            /* @var $aTag \DOMElement */
            $title=$aTag->nodeValue;
            $url=$aTag->getAttribute("href");
            
            $resultsInfos=array();
            if(($protPos=strpos($url, "://"))>0){ //if no protocole it means the result is a an relative path to google. then it means than it is not a true natural result
                $newUrl=  substr($url,$protPos+3);
                $newUrl=  substr($newUrl,0,strpos($newUrl, "/"));
                
                $resultsInfos[]=["url"=>$url,"shorturl"=>$newUrl,"title"=>$title];
            }
            
            var_dump($resultsInfos);
        }
        
        return $number;
    }
    
}

?>
