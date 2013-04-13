<?

$valid=1;
$ip="192.124.154.2";
if ($valid > 0) {

// If we have a good IP address ..
// Use the Maxmind database to find out the probable country.
// (Refer to http://www.maxmind.com for this PHP function)

  if (preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/',$ip)) {
    $rv = getcountry($ip);
    if ($rv[id]) {
      print ("IP address points us to $rv[name] / $rv[id] / $rv[code]<br>");
      if ($valid == 2 ) {
        print ("You entered a computer name. This country may be where ");
        print ("the company's computers are located - perhaps at an ISP<br>");
      }
    } else {
      print ("IP address does not determine country / region<br>");
      $nonspecific = 1;
    }
    $reg = "";

// If there's a known registry for the country in question, which one?

    if (ereg('^(GB|IE|DE|EU|AD|AT|BE|CH|DK|ES|FI|FR|FX|GI|GR|LI|LU|MC|NO|NL|PT|SE|VE)$',
        $rv[code])) {
        $reg = "whois.ripe.net";
        }
    if (ereg('^(US|CA)$',
        $rv[code])) {
        $reg = "whois.arin.net";
        }
    if ($reg) {
      print ("<br><b>IP Address registry Information from $reg</b>");
      if (ereg("^192\.168",$_SERVER[REMOTE_ADDR])) {
        $fullipinfo = `whois -h $reg $ip`;
      } else {
        $fullipinfo = "Lookup of $ip at $reg disabled on public server";
      }
      print ("<br><PRE>$fullipinfo</PRE><br>");
    } else {
      if ($nonspecific == 1) {
      print ("<br><b>We cannot look up further IP details in this instance.</b> ".
       "This may be an IP address from a local network, it may be ".
       "incorrectly entered or setup, or it may be newly registered</b><br>");
      } else {
        print ("<br><b>We do not yet look up IP details in this country</b><br>");
      }
    }
  } else {
    print ("<br><b>We do not have an IP address to look up in the registry</b><br>");
  }

// If we have a good Domain Name ..
// No need to use MaxMind here ... straight to the registry!

  $dbname = ""; $sname = "";
  if (preg_match('/([-a-zA-Z0-9]+)\.([a-zA-Z]{2,6})$/',$hname,$hnp)) {
    if (ereg('^(co|me|org|plc|ltd|net|sch)$',$hnp[1]) and $hnp[2] == "uk") {
      if (preg_match('/([-a-zA-Z0-9]+)\.([-a-zA-Z0-9]+)\.([a-zA-Z]{2,6})$/',$hname,$hnp)) {
        $dbname = "whois.nic.uk";
        $sname = "$hnp[1].$hnp[2].uk";
        }
      }
    if (ereg('^(gov|ac)$',$hnp[1]) and $hnp[2] == "uk") {
      if (preg_match('/([-a-zA-Z0-9]+)\.([-a-zA-Z0-9]+)\.([a-zA-Z]{2,6})$/',$hname,$hnp)) {
        $dbname = "whois.ja.net";
        $sname = "$hnp[1].$hnp[2].uk";
        }
      }
    if (ereg('^(net|edu)$',$hnp[2])) {
      $dbname = "whois.networksolutions.com";
      $sname = "$hnp[1].$hnp[2]";
      }
    if (ereg('^(com)$',$hnp[2])) {
      $dbname = "whois.totalregistrations.com";
      $sname = "$hnp[1].$hnp[2]";
      }
    if (ereg('^(int)$',$hnp[2])) {
      $dbname = "whois.icann.org";
      $sname = "$hnp[1].$hnp[2]";
      }
    if (ereg('^(ie)$',$hnp[2])) {
      $dbname = "whois.domainregistry.ie";
      $sname = "$hnp[1].$hnp[2]";
      }
    if (ereg('^(nl)$',$hnp[2])) {
      $dbname = "whois.domain-registry.nl";
      $sname = "$hnp[1].$hnp[2]";
      }
    if (ereg('^(co)$',$hnp[1]) and $hnp[2] == "za") {
      if (preg_match('/([-a-zA-Z0-9]+)\.([-a-zA-Z0-9]+)\.([a-zA-Z]{2,6})$/',$hname,$hnp)) {
        $dbname = "http://co.za/cgi-bin/whois.sh";
        $sname = "Domain=$hnp[1]";
        $viaweb = 1;
        }
      }
    if ($dbname != "") {
      print ("<br><b>Domain Name registry information from $dbname</b>");
      if ($viaweb == 1) {
        $fullnameinfo = strip_tags(join("",file($dbname."?".$sname)));
      } else {
        if (ereg("^192\.168",$_SERVER[REMOTE_ADDR])) {
          $fullnameinfo = `whois -h $dbname $sname`;
        } else {
        $fullnameinfo = "Lookup of $sname at $dbname disabled on public server";
        }
      }
      print ("<br><PRE>$fullnameinfo</PRE><br>");
    } else {
      print ("<br><b>We do not yet look up host details in this top level domain</b><br>");
    }
  } else {
    print ("<br><b>We do not have a full host name to look up in the registry</b><br>");
  }
}

?>