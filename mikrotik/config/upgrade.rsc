/system scheduler add interval=1d name=upgrade on-event=upgrade policy=\
    ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon start-date=dec/20/2019 start-time=\
    23:00:00
/system script add dont-require-permissions=no name=upgrade owner=admin policy=\
    ftp,reboot,read,write,policy,test,password,sniff,sensitive,romon source="###############################\
    ########################\r\
    \n#                  UPGRADE MIKROTIK                   #\r\
    \n#######################################################\r\
    \n#EMAIL\r\
    \n\r\
    \n:local notifyViaMail\ttrue\r\
    \n:local email\t\t\t\"r.guitteau@ceso-gto.com\"\r\
    \n\r\
    \n/tool e-mail set address=relay.ceso-gto.com from=r.guitteau@ceso-gto.com password=\"Kf2aqybz()\" user=\
    r.guitteau@ceso-gto.com\r\
    \n#########################################################################\r\
    \n# download and upgrade\r\
    \n#########################################################################\r\
    \n\r\
    \n:local myVer [/system package update get installed-version];\r\
    \n\r\
    \n#detect platform (architecture-name is not available in older 3.x versions)\r\
    \n:local platform [/system resource get architecture-name];\r\
    \n\r\
    \n\r\
    \n#fetch latest version\r\
    \n/tool fetch address=\"192.168.98.165\" src-path=\"latestVer.txt\" mode=http;\r\
    \n:local lVer [/file get latestVer.txt content];\r\
    \n\t\r\
    \n:if (\$myVer != \$lVer) do={\r\
    \n\t:log warning (\"Mise \E0 jour du syst\E8me en cours\");\r\
    \n\t:local pckgName \"routeros-\$platform-\$lVer.npk\";\r\
    \n\t:if (\$notifyViaMail) do={\r\
    \n       \t/tool e-mail send to=\"\$email\" subject=\"Upgrading firmware on router \$[/system identity g\
    et name]\" body=\"Upgrading firmware on router \$[/system identity get name] from \$[/system package upd\
    ate get installed-version] to \$pckgName\";\r\
    \n    }\r\
    \n\t/tool fetch address=\"192.168.98.165\" host=\"192.168.98.165\" mode=http src-path=\"\$pckgName\";\r\
    \n\t/system reboot;\r\
    \n} else={\r\
    \n    :log info (\"Upgrade_script: already latest version\");\r\
    \n}"