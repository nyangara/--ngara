<?php
// taken from http://jking.dark-phantasy.com/code/php/class.contentnegotiation.phps
class contentNegotiation {

// See http://jking.dark-phantasy.com/code/ for usage and notes
// Last modified 2004-10-29

var $trim = ",; \t\n\r\0\x0B";
var $accept;
var $encoding;
var $charset;
var $language;

function getQ($member, $header = "accept")
  {$header = $this->determineHeader($header);
   $member = $this->splitMember($member);
   switch($header) {
    case "accept":
     for ($a = 0; $a < sizeof($this->{$header}); $a++)
      {if (array_intersect($this->{$header}[$a], $member)==$member)                                                   return $this->{$header}[$a]['q'];}
     if (isset ($this->{$header}['phpcontentnegotiationmember'])) {
       $major = explode("/", $this->{$header}['phpcontentnegotiationmember']);
     } else {
       $major = "*";
     }
     $major = "$major[0]/*";
     for ($a = 0; $a < sizeof($this->{$header}); $a++)
      {if ($this->{$header}[$a]['phpcontentnegotiationmember']==$major)                                               return $this->{$header}[$a]['q'];}
     for ($a = 0; $a < sizeof($this->{$header}); $a++)
      {if ($this->{$header}[$a]['phpcontentnegotiationmember']=="*/*")                                                return $this->{$header}[$a]['q'];}
     break;
    default:
     for ($a = 0; $a < sizeof($this->{$header}); $a++)
      {if ($this->{$header}[$a]['phpcontentnegotiationmember']==$member['phpcontentnegotiationmember'])               return $this->{$header}[$a]['q'];}
     if ($header=="language")
      {for ($a = 0; $a < sizeof($this->{$header}); $a++)
        {if ($this->{$header}[$a]['phpcontentnegotiationmember']==substr($member['phpcontentnegotiationmember'],0,2)) return $this->{$header}[$a]['q'];} }
     for ($a = 0; $a < sizeof($this->{$header}); $a++)
      {if ($this->{$header}[$a]['phpcontentnegotiationmember']=="*")                                                  return $this->{$header}[$a]['q'];}
    }    
   return 0;
  }
     
function compareQ($members, $header = "accept")
  {$array = explode(",", $members);
   $members = NULL;
   for ($a = 0; $a < sizeof($array); $a++)
    {$data = $this->splitMember($array[$a]);
     $members[$array[$a]] = $this->getQ($array[$a], $header);}
   asort($members);
   $members = array_flip(array_map(array($this,"makeString"),$members));
   return array_pop($members);
  }

function getPref($family = "html")
  {//This is just an alias for various uses of 'compareQ'
   switch($family) {
    case "img":     return $this->compareQ("image/png,image/gif,image/jpeg");
    case "html":    return $this->compareQ("application/xhtml+xml,text/html");
    case "news":    return $this->compareQ("application/atom+xml,application/rdf+xml,application/x-rdf+xml,application/rss+xml,application/x-rss+xml,application/xml");
    case "video":   return $this->compareQ("video/quicktime,video/x-msvideo,application/vnd.rn-realmedia,video/x-ms-asf,video/x-ms-wmv,video/mpeg");
    case "audio":   return $this->compareQ("application/ogg,audio/mpeg,audio/x-ms-wma,audio/x-realaudio,audio/wav,audio/basic");
    case "archive": return $this->compareQ("application/x-rar-compressed,application/x-stuffit,application/zip,application/bzip2,application/x-tar");
    case "lang":    return $this->compareQ($_SERVER['HTTP_ACCEPT_LANGUAGE'], "l");
    case "enc":     return $this->compareQ("gzip,x-gzip,identity", "e");
    case "charset": return $this->compareQ("utf-8,iso-8859-1,windows-1252", "c");
   }
  }


////////  Internal methods  ////////

function contentNegotiation()
  {header("Vary: Accept",1);
  $members = "";
  if (array_key_exists('HTTP_ACCEPT',$_SERVER)) {
   $members = $_SERVER['HTTP_ACCEPT'];
  }
   if ($members=="*/*" || $members=="image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, */*" && strpos($_SERVER['HTTP_USER_AGENT'], "MSIE"))
    {$members = "text/html,application/xml,image/jpeg,image/pjpeg,image/x-xbitmap,image/gif,image/png;q=0.9,*/*;q=0.1";}   //special case for Internet Explorer to give it a sensible Accept string according to its actual capabilities
   $members = trim($members, $this->trim);
   $this->accept = explode(",", $members);
   for ($a = 0; $a < sizeof($this->accept); $a++)
    {$this->accept[$a] = $this->splitMember($this->accept[$a],1);}
   if (isset ($_SERVER['HTTP_ACCEPT_ENCODING'])) {
     $members = strtolower(trim($_SERVER['HTTP_ACCEPT_ENCODING'], $this->trim));
   }
   if (!$members)
    {$members = "identity,*;q=0.9";} //suggested sensible default according to HTTP/1.1
   $this->encoding = explode(",", $members);
   for ($a = 0; $a < sizeof($this->encoding); $a++)
    {$this->encoding[$a] = $this->splitMember($this->encoding[$a],1);}
   if ($this->getQ("identity", "encoding")==0 && strpos($members, "identity")===FALSE && strpos($members, "*")===FALSE)
    {$this->encoding[] = array('coding' => 'identity', 'q' => '1');}
   if (isset ($_SERVER['HTTP_ACCEPT_CHARSET'])) {
     $members = strtolower(trim($_SERVER['HTTP_ACCEPT_CHARSET'], $this->trim));
   }
   if (!$members)
    {$members = "*";}
   $this->charset = explode(",", $members);
   for ($a = 0; $a < sizeof($this->charset); $a++)
    {$this->charset[$a] = $this->splitMember($this->charset[$a],1);}
   if ($this->getQ("iso-8859-1", "charset")==0 && strpos($members, "iso-8859-1")===FALSE && strpos($members, "*")===FALSE)
    {$this->charset[] = array('charset' => 'iso-8859-1', 'q' => '1');}
   if (isset ($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
     $members = strtolower(trim($_SERVER['HTTP_ACCEPT_LANGUAGE'], $this->trim));
   }
   if (!$members)
    {$members = "*";}
   $this->language = explode(",", $members);
   for ($a = 0; $a < sizeof($this->language); $a++)
    {$this->language[$a] = $this->splitMember($this->language[$a],1);}
   
   
  }

function splitMember($data, $fillQ = 0)
  {$data = explode(";", strtolower(str_replace(" ", "", trim($data, $this->trim))));
   for ($a = 1; $a < sizeof($data); $a++)
    {$data[$a] = explode("=", $data[$a]);
     $type[$data[$a][0]] = $data[$a][1];}
   if ($fillQ && !isset($type['q']))
    {$type['q'] = "1";}
   settype($type['q'], "double");
   if (!$fillQ && isset($type['q']))
    {unset($type['q']);}
   $type['phpcontentnegotiationmember'] = $data[0];
   return $type;
  }

function determineHeader($header)
  {switch($header) {
    case "accept":
    case "content-type":
    case "type":
    case "a":
     return "accept";
    case "accept-language":
    case "language":
    case "lang":
    case "l":
     return "language";
    case "accept-encoding":
    case "encoding":
    case "enc":
    case "e":
     return "encoding";
    case "accept-charset":
    case "charset":
    case "set":
    case "c":
     return "charset";
    default:
     return "accept"; }
  }

function makeString($var)
  {settype($var, "string");
   return $var;
  }
}
?>
